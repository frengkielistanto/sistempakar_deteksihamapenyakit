package com.sistempakar.spk.Model;

public class Gejala_Model {
    String kode;
    String nama;
    int cfuser;


    public Boolean getIsActive() {
        return isActive;
    }

    public void setIsActive(Boolean isActive) {
        this.isActive = isActive;
    }

    Boolean isActive;

    public String getKode() {
        return kode;
    }

    public void setKode(String kode) {
        this.kode = kode;
    }

    public String getNama() {
        return nama;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public int getCfuser() {
        return cfuser;
    }

    public void setCfuser(int cfuser) {
        this.cfuser = cfuser;
    }
}