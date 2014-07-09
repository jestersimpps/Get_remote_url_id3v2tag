Get_remote_url_id3v2tag
=======================
example project.

id3v2 tag info can only get extracted for local files using https://github.com/JamesHeinrich/getID3.
the getid3 library throws the following error when loading a remote file:

'Remote files are not supported - please copy the file locally first'

To solve this issue, this example gets info out of the id3v2 tag of a remote file 
downloading only the first and last 64KB of the file.
