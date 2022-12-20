package com.sistempakar.spk;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.sistempakar.spk.Adapter.Adapter_Gejala;
import com.sistempakar.spk.Model.Gejala_Model;
import com.sistempakar.spk.config.AppController;
import com.sistempakar.spk.config.ServerAccess;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class KonsultasiActivity extends AppCompatActivity {
    private Adapter_Gejala adapter;
    private List<Gejala_Model> list;
    private RecyclerView listdata;
    RecyclerView.LayoutManager mManager;
    Button button3;
    ProgressDialog pd;
    List<String> kode= new ArrayList<String>();
    List<String> cfuser= new ArrayList<String>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_konsultasi);
        listdata = (RecyclerView)findViewById(R.id.listdata);
        button3 = findViewById(R.id.button3);
        listdata.setHasFixedSize(true);
        list = new ArrayList<>();
        adapter = new Adapter_Gejala(KonsultasiActivity.this,(ArrayList<Gejala_Model>) list, this);
        mManager = new LinearLayoutManager(KonsultasiActivity.this,LinearLayoutManager.VERTICAL,false);

        listdata.setLayoutManager(mManager);
        listdata.setAdapter(adapter);
        pd = new ProgressDialog(KonsultasiActivity.this);
        button3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
//                Log.d("kode", kode.toString());
                hitung();
            }
        });
        loadJson();
    }
    private void loadJson()
    {
        String link = ServerAccess.KONSULTASI;
        StringRequest senddata = new StringRequest(Request.Method.GET, link, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    JSONArray arr = res.getJSONArray("gejala");
                    if(arr.length() > 0) {
                        for (int i = 0; i < arr.length(); i++) {
                            try {
                                JSONObject data = arr.getJSONObject(i);
                                Gejala_Model md = new Gejala_Model();
                                md.setKode(data.getString("id"));
                                md.setNama(data.getString("nama_gjl"));
                                md.setIsActive(false);
                                md.setCfuser(0);
                                list.add(md);
                            } catch (Exception ea) {
                                ea.printStackTrace();
                                Log.d("pesan", ea.getMessage());
                            }
                        }
                        adapter.notifyDataSetChanged();
                    }else{
//                        not_found.setVisibility(View.VISIBLE);
                        Toast.makeText(getBaseContext(), "Data Kosong", Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(getBaseContext(), "Data Kosong", Toast.LENGTH_SHORT).show();
                    Log.d("pesan", "error "+e.getMessage());
                    e.printStackTrace();
                }
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getBaseContext(), "Data Kosong", Toast.LENGTH_SHORT).show();
                        Log.d("volley", "errornya : " + error.getMessage());
                    }
                });
        AppController.getInstance().addToRequestQueue(senddata);
    }
    public void hitung(){
        for (int i = 0; i < list.size(); i++){
            try {
                Gejala_Model md = list.get(i);
                if (md.getCfuser()!=0){
                    cfuser.add((md.getKode().toString()+"789"+md.getCfuser()));
                    kode.add(md.getKode());
                }
            } catch (Exception ea) {
                ea.printStackTrace();
                Log.d("pesan", ea.getMessage());
            }
        }
        if(kode.isEmpty()){
            Toast.makeText(getBaseContext(), "Pilihan Tidak Boleh Kosong", Toast.LENGTH_SHORT).show();
        }else{
            adapter.notifyDataSetChanged();
            Intent intent = new Intent(getBaseContext(), HasilActivity.class);
            intent.putExtra("kode", kode.toString());
            intent.putExtra("cfuser", cfuser.toString());
           // startActivity(new Intent(intent));
            Log.d("test", kode.toString());
            kode.clear();
            startActivity(new Intent(intent));
        }
    }
}