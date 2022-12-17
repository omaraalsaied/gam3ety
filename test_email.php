<?php

if(mail("amressa201611@gmail.com","Verify Your Email","<h3>You are logged in to Gam3eity website and we want to make sure that you own the email </h3><br>" . "\r\n" . "<h2>Your Verification code is :- " . "256245" . "</h2> " . "\r\n" . " <br> please go to our site and enter the verification code","From: Gam3eity <amressa201311@gmail.com>\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n")){
            echo "success";
        }else{
            echo "fail";
        }
