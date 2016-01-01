#Minecraft SRV

####What is it?
Allows users to create a SRV record for their Minecraft server from the web. It will use the Cloudflare API and Mandrill to create records and send people their emails.

You should change the HTML to something more appropriate.

If you want the previous version (That isn't save to use!) so you don't have to use composer you can download it [here](https://github.com/Taronyuu/Minecraft-SRV/archive/48437302ab903f5289e2cfe705fde1048d9ba8f5.zip)

####Requirements
You must use the DNS service from Cloudflare
Webserver including PHP (5.5.9+)
MySQL database

####Installation
- Clone this repo and copy .env.example to .env
- Create a database
- Fill in your MySQL details in your .env file
- Fill in the other details in your .env file (Cloudflare details and Mandrill details)
- Run 'composer install'
- Enjoy