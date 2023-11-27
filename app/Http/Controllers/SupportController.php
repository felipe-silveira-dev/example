<?php

namespace App\Http\Controllers;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service
    ) {
    }

    public function index(Request $request)
    {

        dd($this->service->paginate());
        $request->validate([
            'filter' => 'nullable|string|max:255'
        ]);

        try {
            $filter = $request->input('filter');

            // Se houver um filtro, aplicar trim
            $filter = $filter ? trim($filter) : null;

            // Obtenção dos dados com tratamento do filtro
            $supports = $this->service->getAll($filter);

            return view('support.index', compact('supports'));
        } catch (\Exception $e) {
            // Tratamento de exceção (adapte conforme necessário)
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar a requisição.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupportRequest $request)
    {
        try {
            $this->service->store(CreateSupportDTO::makeFromRequest($request));

            return redirect()->back()->with('success', 'Suporte criado com sucesso!');
        } catch (\Exception $e) {
            // Tratamento de exceção (adapte conforme necessário)
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar a requisição.'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $support = $this->service->findOnebyId($id);

            return view('support.show', compact('support'));
        } catch (\Exception $e) {
            // Tratamento de exceção (adapte conforme necessário)
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar a requisição.'.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Support $support)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupportRequest $request)
    {
        try {

            $this->service->update(UpdateSupportDTO::makeFromRequest($request));

            return redirect()->back()->with('success', 'Suporte atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar a requisição.'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {

    }
}
