<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVigenciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'data_inicio' => 'required|date',
            'data_fim' => ['required', 'date', function ($attribute, $value, $fail) {
                if (strtotime($value) < strtotime(now()->toDateString())) {
                    $fail('A data de fim não pode ser menor que a data atual.');
                } else if (strtotime($value) < strtotime($this->input('data_inicio'))) {
                    $fail('A data de fim não pode ser menor que a data inicial.');
                }
            }],
            'contrato_id' => 'required|exists:contratos,id',
            'valor_ponto_funcao' => 'required',
            'valor_hora' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'data_inicio.required' => 'A data de início é obrigatória.',
            'data_fim.required' => 'A data de fim é obrigatória.',
            'data_fim.date' => 'A data de fim deve ser uma data válida.',
            'data_fim.before_or_equal' => 'A data de fim não pode ser menor que a data atual.',
            'contrato_id.required' => 'O ID do contrato é obrigatório.',
            'contrato_id.exists' => 'O contrato selecionado é inválido.',
            'valor_ponto_funcao.required' => 'O valor do ponto de função é obrigatório.',
            'valor_hora.required' => 'O valor da hora é obrigatório.',
        ];
    }
}
