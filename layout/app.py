from flask import Flask, render_template
from flask import request
import time as t
import requests
import json
from threading import Thread



app = Flask(__name__)


def get_rows(start, end, buf):
    triangle = json.loads(requests.get('http://pascal/pascal.php?start=' + str(start) + '&end=' + str(end)).content)
    for i in range(start,end):
        buf[i] = triangle[i - start]



@app.route('/')
def build_triangle():
    start = t.time()
    rows = int(request.args.get('rows'))
    res = [None] * rows
    t1 = Thread(target = get_rows, args = (0,rows-1,res))
    t1.start()
    get_rows(rows-1,rows,res)
    t1.join()


    end = t.time()
    time_passed = end - start
    return render_template('index.html',rows=rows,triangle=res,time=time_passed)

if __name__ == '__main__':
    app.run()
