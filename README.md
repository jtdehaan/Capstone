# Med Connect
A way for patients with medical conditions to find events that will help them while also giving doctors information and event holders a platform.


| Key   |      Value    |
|----------|-------------|
| Platform | Web,Android |
| AI | {Put your AI's Name here in Last, First format} {AI email} |

# Team
- De Haan, Jacob (Database Lead) jtdehaan@indiana.edu
- Last, First (Role) email
- Last, First (Role) email

# App Information
[More App Information](app/README.md)

##PHP
Login_Doctor-POST: username, password
Login_Organization-POST: username, password
Login_Patient-POST: username, password
Register_Doctor-POST: name, username, password, email
Register_Orginization-POST: name, username, password, email
Register_Patient-POST: name, username, password, email
activate_doctor-POST: Email_code
activate_organization-POST: Email_code 
activate_patient-POST: Email_code
Edit_Patient-POST: username, email, userID 
Edit_Doctor-POST: username, email, userID 
Edit_Organization-POST: username, email, userID 
Add_Event_APP-POST: Eventname, Location, Email, Times 
UpdateEventAPP-POST: Eventname, Location, Email, Times  