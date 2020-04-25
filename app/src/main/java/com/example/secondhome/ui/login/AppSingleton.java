package com.example.secondhome.ui.login;
import android.content.Context;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;
import com.example.secondhome.data.model.LoggedInUser;

public class AppSingleton {
    private static AppSingleton mAppSingletonInstance;
    private RequestQueue mRequestQueue;
    private static Context mContext;
    private static LoggedInUser user=null;
    private static String animalsToShow=null;
    private static int location=0;
    private AppSingleton(Context context) {
        mContext = context;
        mRequestQueue = getRequestQueue();
    }

    public static synchronized AppSingleton getInstance(Context context) {
        if (mAppSingletonInstance == null) {
            mAppSingletonInstance = new AppSingleton(context);
        }
        return mAppSingletonInstance;
    }
    public void setLocation(int l){ location=l;}
    public int getLocation(){return location;}
    public RequestQueue getRequestQueue() {
        if (mRequestQueue == null) {
            // getApplicationContext() is key, it keeps you from leaking the
            // Activity or BroadcastReceiver if someone passes one in.
            mRequestQueue = Volley.newRequestQueue(mContext.getApplicationContext());
        }
        return mRequestQueue;
    }
    public LoggedInUser getUser(){
        return user;
    }
    public String getLoggedInUserName()
    {
        return user.getDisplayName();

    }
    public void setAnimalsToShow(String s){
        System.out.println("in animals");
        animalsToShow=s;}
    public String getAnimalsToShow(){if(animalsToShow!=null) return animalsToShow;
        return "0";}
    public void setUser(LoggedInUser u)
    {
        this.user=u;
    }
    public <T> void addToRequestQueue(Request<T> req,String tag) {
        req.setTag(tag);
        getRequestQueue().add(req);
    }
    public void logoutUser()
    {
        this.user=null;
    }
}

