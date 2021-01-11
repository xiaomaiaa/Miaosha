#!/usr/bin/env python
from wsgiref.simple_server import make_server
import pika

cnt=0

def server(environ,start_response):
    global cnt
    #start_response('200 OK',[('Content-Type','text/html')])
    #print('QS',environ['QUERY_STRING'])
    query=environ['QUERY_STRING']
    if query!='':
        #cnt+=1
        channel.basic_publish(exchange='',
                            routing_key='hello',
                            body=query)
        #print("Sent query",cnt,query)
    status = '200 OK'
    response_headers = [('Content-type', 'application/json'),
                        ('Access-Control-Allow-Origin', '*'),
                        ('Access-Control-Allow-Methods', 'POST'),
                        ('Access-Control-Allow-Headers', 'x-requested-with,content-type'),
                        ]  # json 
    start_response(status, response_headers)
    return [b'<h1>Query sent.</h1>']

print('start server')
connection = pika.BlockingConnection(pika.ConnectionParameters('localhost',heartbeat=0))
channel = connection.channel()
channel.queue_declare(queue='hello')
port=9001
httpd=make_server('',port,server)
httpd.serve_forever()
connection.close()