## PUSH TESTER

```
URL https://tensend.me/secure/config/send-push?phone=7777777777

должно прилететь test test
делаете обычный ГЕТ запрос через браузер на этот урл
тупо вставьте в урл и сделайте ENTER 
``` 

### PUSHES
```
    
    GENERAL_PUSH = 1
    {
    
        ANDROID
         
        payload: {
                 "type" => 1,
                 "image_url" => String,
                 "title" => String,
                 "description" => String   
                 }
        
        IOS
        
        payload: {
                 "type" => 1,
                 "image_url" => String,
                 "title" => String,
                 "body" => String   
                 }
    }
    
    SOON WE WILL HAVE ANOTHER PUSH TYPES...
             
``` 