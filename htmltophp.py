import os

files = os.listdir()
files = [name for name in files if (name.endswith(".html") or name.endswith(".php"))]
for htmlfile in files:
    text = ""
    with open(htmlfile,"r") as f:
        text = f.read()
    text=text.replace(".html",".php")
    with open(htmlfile,"w") as f:
        f.write(text)
    try:
        os.rename(htmlfile,htmlfile.replace(".html",".php"))
    except:
        print(htmlfile)