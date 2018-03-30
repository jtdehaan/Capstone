package com.example.android.medconnect;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;
import com.example.android.medconnect.MyEventsDownloader;

import org.json.JSONException;
import org.json.JSONObject;

public class MyEventsActivity extends AppCompatActivity {

    String urlAddress = "http://cgi.soic.indiana.edu/~team37/My_Events.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_events);
        final ListView lv = (ListView) findViewById(R.id.lv);

        //REQUEST

        /*

        SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
        String OrganizationID = sharedPref.getString("user_id", "");

        Response.Listener<String> responseListener = new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonResponse = new JSONObject(response);
                    boolean success = jsonResponse.getBoolean("success");
                    if (success) {
                        Toast.makeText(MyEventsActivity.this, "Displaying your events...", Toast.LENGTH_SHORT).show();
                    } else {
                        Toast.makeText(MyEventsActivity.this, "Error fetching your events...", Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        };

        MyEventsRequest myEventsRequest = new MyEventsRequest(OrganizationID, responseListener);
        RequestQueue queue = Volley.newRequestQueue(MyEventsActivity.this);
        queue.add(myEventsRequest);

        //END REQUEST

        */

        MyEventsDownloader d = new MyEventsDownloader(MyEventsActivity.this, urlAddress, lv);
        d.execute();
    }
}
