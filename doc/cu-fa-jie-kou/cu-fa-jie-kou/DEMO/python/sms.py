#!/usr/local/bin/python
#-*- coding:utf-8 -*-
import httplib
import urllib

host  = "106.ihuyi.com"
sms_send_uri = "/webservice/sms.php?method=Submit"

#账号
account  = "cf_xxxxx"
#密码 查看密码请登录用户中心->验证码、通知短信->帐户及签名设置->APIKEY
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
    text = "您的验证码是：121254。请不要把验证码泄露给其他人。"

    print(send_sms(text, mobile))