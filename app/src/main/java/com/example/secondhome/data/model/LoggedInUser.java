package com.example.secondhome.data.model;

/**
 * Data class that captures user information for logged in users retrieved from LoginRepository
 */
public class LoggedInUser {

    private String userEmail;
    private String displayName;

    public LoggedInUser(String userId, String displayName) {
        this.userEmail = userId;
        this.displayName = displayName;
    }

    public String getUserId() {
        return userEmail;
    }

    public String getDisplayName() {
        return displayName;
    }
}
