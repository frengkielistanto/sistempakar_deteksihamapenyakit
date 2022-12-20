package com.sistempakar.spk.Adapter;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.Switch;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

import com.sistempakar.spk.Model.Gejala_Model;
import com.sistempakar.spk.Model.Hasil_Model;
import com.sistempakar.spk.R;

import java.util.ArrayList;

public class Adapter_Hasil extends RecyclerView.Adapter<Adapter_Hasil.ViewHolder>  {
    private ArrayList<Hasil_Model> listdata;
    private Activity activity;
    private Context context;

    public Adapter_Hasil(Activity activity, ArrayList<Hasil_Model> listdata, Context context) {
        this.listdata = listdata;
        this.activity = activity;
        this.context = context;
//        this.onCLickYes = onCLickYes;
    }


    @Override
    public Adapter_Hasil.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.template_hasil, parent, false);
        Adapter_Hasil.ViewHolder vh = new Adapter_Hasil.ViewHolder(v);
        return vh;
    }
    @SuppressLint("RecyclerView")
    @Override
    public void onBindViewHolder(Adapter_Hasil.ViewHolder holder, final int position) {
        int posisi = position;
        Hasil_Model md = listdata.get(position);
        holder.kode.setText(listdata.get(position).getKode());
        holder.penyakit.setText(listdata.get(position).getPenyakit());
        holder.gejala.setText(listdata.get(position).getGejala());
        holder.solusi.setText(listdata.get(position).getSolusi());
       holder.semuagejala.setText(listdata.get(position).getSemuagejala());
        holder.jenis.setText(listdata.get(position).getJenis());
        holder.presentase.setText(listdata.get(position).getPresentase());
        holder.kode.setVisibility(View.GONE);
        holder.mContext = context;

    }
    @Override
    public int getItemCount() {
        return listdata.size();
    }
    public static class ViewHolder extends RecyclerView.ViewHolder {
        private TextView kode, penyakit, gejala, solusi, jenis, presentase, semuagejala;
        Switch choice;
        Context mContext;
        ImageView cover;
        public ViewHolder(View v) {
            super(v);
            kode=(TextView)v.findViewById(R.id.kode);
            penyakit=(TextView)v.findViewById(R.id.penyakit);
            gejala=(TextView)v.findViewById(R.id.gejala);
            solusi=(TextView)v.findViewById(R.id.solusi);
            jenis=(TextView)v.findViewById(R.id.jenis);
            semuagejala=(TextView)v.findViewById(R.id.semuagejala);
            presentase=(TextView)v.findViewById(R.id.presentase);

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