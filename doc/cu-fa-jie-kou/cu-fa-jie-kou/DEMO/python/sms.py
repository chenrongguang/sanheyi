#!/usr/local/bin/python
#-*- coding:utf-8 -*-
import httplib
import urllib

host  = "106.ihuyi.com"
sms_send_uri = "/webservice/sms.php?method=Submit"

#�˺�
account  = "cf_xxxxx"
#���� �鿴�������¼�û�����->��֤�롢֪ͨ����->�ʻ���ǩ������->APIKEY
password = "xxxxxxxx"

def send_sms(text, mobile):
    params = urllib.urlencode({'account': account, 'password' : password, 'content': text, 'mobile':mobile,'format':'json' })
    headers = {"Content-type": "application/x-www-form-urlencoded", "Accept": "text/plain"}
    conn = httplib.HTTPConnection(host, port=80, timeout=30)
    conn.request("POST", sms_send_uri, params, headers)
    response = conn.getresponse()
    response_str = response.read()
    conn.close()
    return response_str 

if __name__ == '__main__':

    mobile = "138xxxxxxxx"
    text = "������֤���ǣ�121254���벻Ҫ����֤��й¶�������ˡ�"

    print(send_sms(text, mobile))