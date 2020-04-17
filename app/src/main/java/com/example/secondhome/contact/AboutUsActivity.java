package com.example.secondhome.contact;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.TextView;

import com.example.secondhome.R;

public class AboutUsActivity extends AppCompatActivity {
    TextView title;
    TextView content;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_about_us);
        title=(TextView) findViewById(R.id.contactTitle);
        content=(TextView)findViewById(R.id.contactContent);
        title.setText(R.string.aboutus);
        content.setText(R.string.aboutusContent);

    }
}
