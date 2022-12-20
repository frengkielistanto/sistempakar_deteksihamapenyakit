package com.sistempakar.spk.Adapter;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.Spinner;

import android.widget.TextView;
import android.widget.Toast;

import androidx.recyclerview.widget.RecyclerView;

import com.sistempakar.spk.Model.Gejala_Model;
import com.sistempakar.spk.R;

import java.util.ArrayList;

public class Adapter_Gejala extends RecyclerView.Adapter<Adapter_Gejala.ViewHolder>  {
    private ArrayList<Gejala_Model> listdata;
    private Activity activity;
    private Context context;


    public Adapter_Gejala(Activity activity, ArrayList<Gejala_Model> listdata, Context context) {
        this.listdata = listdata;
        this.activity = activity;
        this.context = context;
//        this.onCLickYes = onCLickYes;
    }


    @Override
    public Adapter_Gejala.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.template_gejala, parent, false);
        Adapter_Gejala.ViewHolder vh = new Adapter_Gejala.ViewHolder(v);
        return vh;
    }
    @SuppressLint("RecyclerView")
    @Override
    public void onBindViewHolder(Adapter_Gejala.ViewHolder holder, final int position) {
        int posisi = position;
        Gejala_Model md = listdata.get(position);
        holder.kode.setText(listdata.get(position).getKode());
        holder.nama.setText(listdata.get(position).getNama());
        holder.kode.setVisibility(View.GONE);
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(context,
                R.array.planets_array, android.R.layout.simple_spinner_item);
// Specify the layout to use when the list of choices appears
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
// Apply the adapter to the spinner
        holder.pspinner.setAdapter(adapter);
        holder.pspinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                md.setCfuser(i);



            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });
        holder.mContext = context;

    }
    @Override
    public int getItemCount() {
        return listdata.size();
    }
    public static class ViewHolder extends RecyclerView.ViewHolder {
        private TextView kode, nama;

        Context mContext;
        ImageView cover;
        Spinner pspinner;
        public ViewHolder(View v) {
            super(v);
            kode=(TextView)v.findViewById(R.id.kode);
            nama=(TextView)v.findViewById(R.id.name);

            pspinner=(Spinner) v.findViewById(R.id.planets_spinner);


            v.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    try {
//                        Intent intent;
//                        Log.d("data", String.valueOf(choice.isChecked()));
//                        intent = new Intent(v.getContext(), Detail_Makanan.class);
//                        intent.putExtra("kode", kode.getText().toString());
//                        v.getContext().startActivity(intent);
                    } catch (Exception e) {
                        Log.d("pesan", "error");
                    }
                }
            });
        }
    }
}