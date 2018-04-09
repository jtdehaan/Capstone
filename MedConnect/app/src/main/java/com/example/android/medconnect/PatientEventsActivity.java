package com.example.android.medconnect;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ListView;

import com.example.android.medconnect.EventsListDownloader;

public class PatientEventsActivity extends AppCompatActivity {

    String urlAddress = "http://cgi.soic.indiana.edu/~team37/Events_List.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_patient_events);
        final ListView lv = (ListView) findViewById(R.id.lv);


        EventsListDownloader d = new EventsListDownloader(PatientEventsActivity.this, urlAddress, lv);
        d.execute();
    }
}
