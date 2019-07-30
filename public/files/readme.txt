1. copy Folder "TaskManager" to C:\xampp\htdocs
2. turn on mongodb service
3. run file "prepare_db.cmd"
4. enter the following line:
	use TaskManager
	db.Users.ensureIndex({name:"text"})
5. run file "start_server.cmd"
6. open localhost:8000 (Internet is required)

(Environment: xampp 3.2.4, mongodb 4)