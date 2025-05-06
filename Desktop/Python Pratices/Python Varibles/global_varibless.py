x = "awesome"

def myfunc():
  #To change the value of a global variable inside a function, refer to the variable by using the global keyword:
  global x
  x = "fantastic"

myfunc()

print("Python is " + x)