# 该代码仅供学习和研究接口使用，只是提供了一个参考

require 'typhoeus'

# 接口地址
url="http://106.ihuyi.com/webservice/sms.php?method=Submit"
# 帐号
account="cf_test"
#密码 查看密码请登录用户中心->验证码、通知短信->帐户及签名设置->APIKEY
password="aaaaaaa"

body={account:account,password:password,mobile:"138xxxxxxxx",content:"您的验证码是：1212。请不要把验证码泄露给其他人。"}

resp=Typhoeus::Request.post(api_send_url,body:body)
puts resp.body