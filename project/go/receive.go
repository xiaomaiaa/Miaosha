package main

import (
	"fmt"
	"log"
	"strings"
	"strconv"
	"github.com/streadway/amqp"
	"database/sql"
    _ "github.com/go-sql-driver/mysql"
)

func failOnError(err error, msg string) {
	if err != nil {
		log.Fatalf("%s: %s", msg, err)
	}
}

var db *sql.DB

func main() {
	db, _ = sql.Open("mysql", "mhy:xiaomai@tcp(localhost:3306)/project?charset=utf8mb4&parseTime=True&loc=Local")
	conn, err := amqp.Dial("amqp://guest:guest@localhost:5672/")
	failOnError(err, "Failed to connect to RabbitMQ")
	defer conn.Close()

	ch, err := conn.Channel()
	failOnError(err, "Failed to open a channel")
	defer ch.Close()

	q, err := ch.QueueDeclare(
		"hello", // name
		false,   // durable
		false,   // delete when unused
		false,   // exclusive
		false,   // no-wait
		nil,     // arguments
	)
	failOnError(err, "Failed to declare a queue")

	msgs, err := ch.Consume(
		q.Name, // queue
		"",     // consumer
		true,   // auto-ack
		false,  // exclusive
		false,  // no-local
		false,  // no-wait
		nil,    // args
	)
	failOnError(err, "Failed to register a consumer")

	forever := make(chan bool)

	go func() {
		for d := range msgs {
			log.Printf("Received a message: %s", d.Body)
			rawquery:=string(d.Body)
			query:=strings.Split(rawquery,"&")
			fmt.Println(query)
			request:=make(map[string]string)
			for i:=0;i<len(query);i++{
				kv:=strings.Split(query[i],"=")
				request[kv[0]]=kv[1]
			}
			fmt.Println(request)
			userid,_:=strconv.Atoi(request["userid"])
			buynum,_:=strconv.Atoi(request["buynum"])
			goodid,_:=strconv.Atoi(request["goodid"])
			fmt.Println(userid)
			fmt.Println(buynum)
			tx, _ := db.Begin()
			_,err1:=tx.Exec("update goods set volumn=volumn-? where id=?",buynum,goodid)
			if err1!=nil{
				_=tx.Rollback()
				fmt.Println("err1")
				return 
			}
			_,err2:=tx.Exec("insert into ordering(userid,goodid,buynum) values (?,?,?)",userid,goodid,buynum)
			if err2!=nil{
				_=tx.Rollback()
				fmt.Println("err2")
				return 
			}
			tx.Commit()
		}
	}()

	log.Printf(" [*] Waiting for messages. To exit press CTRL+C")
	<-forever
}