# �ô������ѧϰ���о��ӿ�ʹ�ã�ֻ���ṩ��һ���ο�

require 'typhoeus'

# �ӿڵ�ַ
url="http://106.ihuyi.com/webservice/sms.php?method=Submit"
# �ʺ�
account="cf_test"
#���� �鿴�������¼�û�����->��֤�롢֪ͨ����->�ʻ���ǩ������->APIKEY
password="aaaaaaa"

body={account:account,password:password,mobile:"138xxxxxxxx",content:"������֤���ǣ�1212���벻Ҫ����֤��й¶�������ˡ�"}

resp=Typhoeus::Request.post(api_send_url,body:body)
puts resp.body