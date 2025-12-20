from flask import Flask, render_template, request, redirect, session
import sqlite3, random, string

app = Flask(__name__)
app.secret_key = "secret123"

def db():
    return sqlite3.connect("users.db")

with db() as con:
    con.execute("CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY, name TEXT, mobile TEXT, username TEXT, password TEXT)")

@app.route("/")
def index():
    return render_template("index.html")

@app.route("/signup", methods=["POST"])
def signup():
    name = request.form["name"]
    mobile = request.form["mobile"]
    username = "NJ" + ''.join(random.choices(string.digits, k=4))
    password = ''.join(random.choices(string.ascii_letters+string.digits, k=6))
    with db() as con:
        con.execute("INSERT INTO users(name,mobile,username,password) VALUES(?,?,?,?)",(name,mobile,username,password))
    return f"Username: {username}<br>Password: {password}<br><a href='/login'>Login</a>"

@app.route("/login", methods=["GET","POST"])
def login():
    if request.method=="POST":
        u=request.form["username"]
        p=request.form["password"]
        cur=db().cursor()
        cur.execute("SELECT * FROM users WHERE username=? AND password=?",(u,p))
        if cur.fetchone():
            session["user"]=u
            return redirect("/dashboard")
        return "Invalid"
    return render_template("login.html")

@app.route("/dashboard")
def dash():
    if "user" not in session:
        return redirect("/login")
    return render_template("dashboard.html")

@app.route("/logout")
def logout():
    session.clear()
    return redirect("/")

app.run(debug=True)