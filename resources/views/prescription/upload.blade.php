@extends('layouts.app')

@section('title', 'Enviar Receita')

@section('content')

<div class="receipt-page">

    <div class="receipt-card">

        <div class="receipt-top">
            <span class="receipt-badge">
                Receita Oftalmológica
            </span>

            <h1>Envie sua receita</h1>

            <p>
                Arraste seu arquivo ou clique para selecionar.
                Formatos aceitos: JPG, PNG e PDF.
            </p>
        </div>

        <form
            method="POST"
            action="{{ route('prescription.store', $order->id) }}"
            enctype="multipart/form-data"
            class="receipt-form"
        >
            @csrf

            <label class="upload-box" id="dropZone">

                <input
                    type="file"
                    id="fileInput"
                    name="file"
                    accept=".jpg,.jpeg,.png,.pdf"
                    required
                >

                <div class="upload-content" id="uploadContent">
                    <div class="upload-icon">📄</div>

                    <h3>Escolher arquivo</h3>

                    <span>
                        Clique ou arraste aqui
                    </span>
                </div>

                <div class="upload-preview hidden" id="uploadPreview">
                    <img id="previewImage">

                    <div class="preview-file" id="previewFile"></div>

                    <button
                        type="button"
                        class="change-file-btn"
                        id="changeFile"
                    >
                        Trocar arquivo
                    </button>
                </div>

            </label>

            @error('file')
                <p class="form-error">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Observações</label>

                <textarea
                    name="observations"
                    rows="4"
                    placeholder="Ex.: lente multifocal..."
                ></textarea>
            </div>

            <button
                type="submit"
                class="btn-primary receipt-btn"
            >
                Enviar receita
            </button>

        </form>

    </div>

</div>

@endsection
