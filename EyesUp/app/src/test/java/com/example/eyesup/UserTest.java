package com.example.eyesup;

import com.example.eyesup.model.Cafe;
import com.example.eyesup.model.User;

import org.junit.Test;

import static junit.framework.TestCase.assertEquals;


public class UserTest {
    @Test
    public void testcheckPasswod(){
        System.out.println("checkPasswod");
        String password = "1234567Cd";
        User instance = new User();
        boolean expResult = true;
        boolean result = instance.checkPasswod(password);
        assertEquals(expResult, result);
    }

    @Test
    public void testcheckPhone(){
        System.out.println("checkPhone");
        String phone = "1234567890";
        User instance = new User();
        boolean expResult = true;
        boolean result = instance.checkPhone(phone);
        assertEquals(expResult, result);
    }
}
