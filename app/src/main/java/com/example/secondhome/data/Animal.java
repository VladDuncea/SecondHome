package com.example.secondhome.data;

public class Animal {
    String PID;
    String name;
    String birthdate;
    String state;
    String description;
    String food;
    String type;
    String breed;
    int has_request;
    String request_type;
    String request_state;
    String image;
    public String getRequest_type(){
        return this.request_type;
    }
    public String getRequest_state(){
        return this.request_state;
    }
    public int getHas_request(){
        return this.has_request;
    }
}
