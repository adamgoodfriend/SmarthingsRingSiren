# SmarthingsRingSiren
Upload the ringauth.php to a web server. Load ringauth.php in your browser and enter your username and password and hit submit.<br>
You should be asked for a 2fa key from your email. enter that in and hit submit again.<br>
<br>
Log into smartthings API by going to https://graph.api.smartthings.com and log in. Go to "My Device Handlers".<br>
Create a new Device Handler from code. Paste the code from RingFloodlightSiren into a device handler. <br>
Click save.<br>
Then Click Publish and select "For Me"<br>
Go to My Devices
Select New Device
Enter the Name of the Siren in "Name" and "Lable"
For Device Network ID paste the Device ID from the ringauth.php page.
For Type scroll down to the botton and selec "Ring Floodlight Siren"
For Version Select Publshed
Select Location and Hub.
Click Create
This shold bring you to a page that has "Preferences (edit)"
Click the edit next to Preferences.
Enter the Device ID from the ringauth.php page
Click Save.
