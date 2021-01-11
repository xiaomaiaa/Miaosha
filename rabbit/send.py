#!/usr/bin/env python
from wsgiref.simple_server import make_server
import pika

def server(environ,start_response):
    query=environ['QUERY_STRING']
    if query!='':
        channel.basic_publish(exchange='',
                            routing_key='hello',
                            body=query)
    status = '200 OK'
    response_headers = [('Content-type', 'application/json'),
                        ('Access-Control-Allow-Origin', '*'),
                        ('Access-Control-Allow-Methods', 'POST'),
                        ('Access-Control-Allow-Headers', 'x-requested-with,content-type'),
                        ]
    start_response(status, response_headers)
    return [b'<h1>Query sent.</h1>']

print('start server')
connection = pika.BlockingConnection(pika.ConnectionParameters(host='localhost',heartbeat=0))
channel = connection.channel()
channel.queue_declare(queue='hello')
port=9001
httpd=make_server('',port,server)
httpd.serve_forever()
connection.close()