package com.example.secondhome.data;

import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.secondhome.data.model.LoggedInUser;

import java.io.IOException;
import com.android.volley.Request;
import com.android.volley.Response;
/**
 * Class that handles authentication w/ login credentials and retrieves user information.
 */
public class LoginDataSource {
    private static final String UrlForLogin="http://secondhome.fragmentedpixel.com/login.php";
    public Result<LoggedInUser> login(String username, String password) {

        try {


            // TODO: handle loggedInUser authentication
            LoggedInUser fakeUser =
                    new LoggedInUser(
                            java.util.UUID.randomUUID().toString(),
                            "Jane Doe");
            return new Result.Success<>(fakeUser);
        } catch (Exception e) {
            return new Result.Error(new IOException("Error logging in", e));
        }
    }

    public void logout() {
        // TODO: revoke authentication
    }
}
