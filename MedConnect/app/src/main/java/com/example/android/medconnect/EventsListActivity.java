package com.example.android.medconnect;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ListView;
import com.example.android.medconnect.EventsListDownloader;

public class EventsListActivity extends AppCompatActivity {

    //PHP URL in order to access the required data from the database
    String urlAddress="http://cgi.soic.indiana.edu/~team37/Events_List.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_events_list);
        final ListView listView= (ListView) findViewById(R.id.lv);

        //Call on and execute the downloader with the provided URL
        EventsListDownloader eventsListDownloader = new EventsListDownloader(EventsListActivity.this,urlAddress,listView);
        eventsListDownloader.execute();
    }
}
