import pika, sys, os
import pymysql

def main():
    db = pymysql.connect("localhost","mhy","xiaomai","project" )
    connection = pika.BlockingConnection(pika.ConnectionParameters(host='localhost'))
    channel = connection.channel()

    channel.queue_declare(queue='hello')

    def callback(ch, method, properties, body):
        #print(" [x] Received %r" % body)
        message=str(body,encoding='utf-8')
        message=message.split('&')
        userid=int(message[0].split('=')[1])
        goodid=int(message[1].split('=')[1])
        buynum=int(message[2].split('=')[1])
        #print(userid,username,goodid,buynum)
        cursor = db.cursor()
        sql1='update goods set volumn=volumn-{} where id={}'.format(buynum,goodid)
        sql2='insert into ordering(userid,goodid,buynum) values ({},{},{})'.format(userid,goodid,buynum)
        try:
            cursor.execute(sql1)
            cursor.execute(sql2)
        except:
            db.rollback()
            print("事务处理失败",e)
        else:
            db.commit()
            print("事务处理成功",userid,goodid,buynum)
        cursor.close()


    channel.basic_consume(queue='hello', on_message_callback=callback, auto_ack=True)

    print(' [*] Waiting for messages. To exit press CTRL+C')
    channel.start_consuming()

if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('Interrupted')
        try:
            sys.exit(0)
        except SystemExit:
            os._exit(0)