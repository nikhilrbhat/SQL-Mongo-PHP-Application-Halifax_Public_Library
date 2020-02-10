All required files are present in the scripts folder. To run the scripts copy the files to a folder on the server and navigate to the folder. The scripts are also uploaded at below path:
	/home/course/u36/project


To run the bashs script run the following after navigating to the directory (/home/course/<<userId>>/mongo):
	sh data2mongo.sh <<DB>> <<userId>> <<pass>>

Once this script is completed, run below command after navigating to the directory (/home/course/<<userId>>/mongo):
	sh mongo2sql.sh <<DB>> <<userId>> <<pass>>

