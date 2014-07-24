Get_remote_url_id3v2tag
=======================
example project.

id3v2 tag info can only be extracted from local files using https://github.com/JamesHeinrich/getID3.
The getid3 library throws the following error when loading a remote file:

'Remote files are not supported - please copy the file locally first'

To extract id3v2 data from remote files, the first and last 64KB of the remote file is downloaded and saved in a temporary folder on the server. Hereafter, id3v2 data can be extracted.

live example @ www.jestersgrid.com/music
