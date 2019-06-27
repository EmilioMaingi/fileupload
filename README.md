# fileupload
## how to use the File upload class

//initialize  
`$newfile = new File();`  
`$newfile->processFile(array('filename'), 'foldername/');`

//check if file has passed validation of size and type  
`if ($newfile->validated()){`  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//move file from temporary location to your folder name  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$newfile->moveFile(0)`  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//getting url to save in db field, save $url to db  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$url = $newfile->getURL(0),`  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//your code for saving  
`}`

//retrieving file, get saved link from db, note the href  
`<a class="btn btn-block rounded-0" target="_blank" href="SAVEDLINK">view file</a>`
