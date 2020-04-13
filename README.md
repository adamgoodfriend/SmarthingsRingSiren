# SmarthingsRingSiren
Upload the ringauth.php to a web server. Load ringauth.php in your browser and enter your username and password and hit submit.<br>
You should be asked for a 2fa key from your email. enter that in and hit submit again.<br>
This should give you an Access Token Refresh Token and a list of your devices and thier Device ID's <br>
Leave this browser window open <br>
<br>
Log into smartthings API by going to https://graph.api.smartthings.com and log in. Go to "My Device Handlers".<br>
Create a new Device Handler from code. Paste the code from RingFloodlightSiren into a device handler. <br>
Edit The code where it says "ENTER REFRESH TOKEN HERE!!!!!!!!" and paste the Refresh Token form the ringauth.php in your browser<br>
Click save.<br>
Then Click Publish and select "For Me"<br>
Go to My Devices<br>
Select New Device<br>
Enter the Name of the Siren in "Name" and "Lable"<br>
For Device Network ID paste the Device ID from the ringauth.php page.<br>
For Type scroll down to the botton and selec "Ring Floodlight Siren"<br>
For Version Select Publshed<br>
Select Location and Hub.<br>
Click Create<br>
This shold bring you to a page that has "Preferences (edit)"<br>
Click the edit next to Preferences.<br>
Enter the Device ID from the ringauth.php page<br>
Click Save.<br>
<br>
<br>
Based all of my Device Handler code off of this project: <br>
https://philipnye.com/2017/12/29/control-your-ring-spotlight-with-alexa-with-smart-things/
