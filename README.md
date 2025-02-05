# two-way-zoho-hub
Making two way integration between zoho to hubspot and vice-versa

*** Workflow for zoho crm ***
1. create account in zoho crm
2 . create account in developer console and get client id and client secret 
3. get code from below uri, we can modify scops 
https://accounts.zoho.in/oauth/v2/auth?scope=ZohoCRM.modules.ALL,ZohoCRM.modules.contacts.ALL&client_id=<client id goes here>&response_type=code&redirect_uri=<redirect uri goes here > &access_type=offline
4. get access token and refresh token and then get access token from refresh token . 
5. Crud for contacts
6. here is the link for create client based application to get client-id and client secret (https://api-console.zoho.in/)


*** Workflow for hubspot ***
1. create account in hubspot and also in developer acccount
2. create private app enter redirect uri and choose scoops

3. copy full URL like --- < https://app.hubspot.com/oauth/authorize?client_id=<client_id goes here >&redirect_uri=<uri goes here >p&scope=crm.objects.contacts.write%20crm.schemas.deals.read%20oauth%20crm.objects.deals.read%20crm.objects.deals.write%20crm.objects.contacts.read>--- 

4. genrate auth code.
5. genrate access token and get refresh token we can also get access token from refresh token.
6. now  you can Crud for hubspot crm


*** Workflow for create contact in hubspot by webhook of zoho crm*** 

1. above all steps (Workflow for hubspot);
2. go to settings -> actions -> creat a workflow rule-> 
3. in trigger action field select webhook.
4. paste uri of file where data will hit on server. (in our case file was zohodata.php You can read it's commits)
5. we can send data to server file by two way 
    I. By header modules (if use this we will extract header in server file)
    II. By  body in row json format data (if use this we will extract body in server file)
6. we will extract data here as per last step we sent and store in .txt file (in our case webhook_log.txt). 
7. we will run create contact API by using access token.
8. here body payload to send data webhook look like Eg.  {
      
      "First Name": "${Contacts.First Name}",
      "Last Name": "${Contacts.Last Name}",
      "Email": "${Contacts.Email}",
      "Phone Number": "${Contacts.Phone}",
      "Zoho_Id": "${Contacts.Contact Id}"
    }


