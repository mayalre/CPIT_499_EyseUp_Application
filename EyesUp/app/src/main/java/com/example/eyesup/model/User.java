package com.example.eyesup.model;

public class User {

    private int id;
    private String userName;
    private String address;
    private String phone;
    private String birthDate;

    public User() {
    }

    public User(int id, String userName, String address, String phone, String birthDate) {
        this.id = id;
        this.userName = userName;
        this.address = address;
        this.phone = phone;
        this.birthDate = birthDate;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getUserName() {
        return userName;
    }

    public void setUserName(String userName) {
        this.userName = userName;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getPhone() {
        return phone;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public String getBirthDate() {
        return birthDate;
    }

    public void setBirthDate(String birthDate) {
        this.birthDate = birthDate;
    }

    public boolean checkPasswod(String password) {

        boolean flag = false;
        if (password.length() >= 8) {
            int charCount = 0;
            int numCount = 0;
            for (int i = 0; i < password.length(); i++) {
                char ch = password.charAt(i);
                if ((ch >= '0' && ch <= '9')) {
                    numCount++;
                } else if (ch >= 'A' && ch <= 'z') {
                    charCount++;
                }
            }
            if (numCount > 0 && charCount > 0) {
                flag = true;
            }
        }
        return flag;
    }

    public boolean checkPhone(String phone) {

        boolean flag = false;
        if (phone.length() >= 10) {
            int charCount = 0;
            int numCount = 0;
            for (int i = 0; i < phone.length(); i++) {
                char ch = phone.charAt(i);
                if ((ch >= '0' && ch <= '9')) {
                    numCount++;
                } else if (ch >= 'A' && ch <= 'z') {
                    charCount++;
                }
            }
            if (numCount > 0) {
                flag = true;
            }

            if (charCount == 0) {
                flag = true;
            }

        }
        return flag;
    }

}
