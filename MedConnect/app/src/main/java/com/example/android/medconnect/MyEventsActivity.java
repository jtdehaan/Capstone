package com.example.android.medconnect;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.ListView;

public class MyEventsActivity extends AppCompatActivity {

    String urlAddress = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_events);
        final ListView lv = (ListView) findViewById(R.id.lv);

        //GET USER_ID & PLACE IN URL
        SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
        final String OrganizationID = sharedPref.getString("user_id", "");

        urlAddress = "http://cgi.soic.indiana.edu/~team37/My_Events.php/?OrganizationID=" + OrganizationID;

        MyEventsDownloader d = new MyEventsDownloader(MyEventsActivity.this, urlAddress, lv);
        d.execute();
    }
}
