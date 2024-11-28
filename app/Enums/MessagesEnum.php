<?php
declare(strict_types=1);

namespace App\Enums;

enum MessagesEnum: string {
    const string METHOD_NOT_ALLOWED = 'Method not allowed.';
    const string RESOURCE_NOT_FOUND = 'Resource not found.';
    const string INTERNAL_SERVER_ERROR = 'Internal server error.';
    const string UNAUTHORIZED = 'Unauthorized.';
    const string NOT_FOUND = 'Not found.';
    const string TOO_MANY_REQUESTS = 'Too Many Attempts.';
    const string ACCESS_DENIED = 'Acesso negado a este recurso.';
    const string INVALID_CODE_TYPE = 'Tipo de código inválido.';
    const string UNIQUE_CODE_PREFIX_NOT_FOUND = 'Prefixo não encontrado.';
    const string IMPOSSIBLE = 'Não foi possível realizar a sua solicitação.';
    const string MICROSERVICE_NOT_AVAILABLE = 'Microservice not available.';
    const string FAILED_TO_RETRIEVE_DATA_MICROSERVICE = 'Failed to retrieve data microservice.';
    const string URI_OR_ROUTE_IS_MISSING = 'Uri ou routing is missing.';

    const string REGISTER_NOT_FOUND = 'Registro não encontrado.';
    const string REGISTER_NOT_ALLOWED = 'Você não tem acesso a este registro.';

    const string INVALID_UUID = 'O valor enviado não é um Uuid válido.';
    const string INVALID_EMAIL = 'O valor enviado não é um E-mail válido.';
    const string INVALID_UNIQUE_NAME = 'O valor enviado não é um nome válido.';
    const string NOT_AUTHORIZED = 'Você não tem permissão para acessar este recurso.';
    const string MODULE_NOT_AUTHORIZED = 'Você não tem permissão para acessar este módulo.';
    const string MUST_BE_AN_ARRAY = 'O campo deve ser um array.';
    const string NOT_ENABLED = 'Você não tem permissão para acessar a plataforma. Para liberar ou verificar seu acesso entre em contato com o suporte.';

    const string LOGIN_ERROR = 'E-mail ou senha incorretos.';
    const string NO_PROFILE = 'Este usuário está vinculado a nenhum perfil do sistema.';
    const string INACTIVE_USER = 'Usuário não encontrado ou está inativo no sistema. Se necessário, entre em contato com o suporte.';
    const string UNVERIFIED_EMAIL = 'E-mail não verificado.';
    const string EMAIL_ALREADY_VERIFIED = 'Este usuário já teve seu e-mail verificado, se necessário entre em contato com o suporte.';
    const string SUCCESS_MODIFY_PASSWORD = 'Senha redefinida com sucesso.';
    const string INVALID_FORGOT_PASSWORD_CODE = 'Código de verificação expirado, por favor solicite uma nova troca de senha.';
    const string INVALID_PROFILE = 'Perfil inválido.';
    const string PASSWORD_CODE_NOT_FOUND = 'Código de verificação não encontrado.';

    const string PRODUCT_NOT_EXISTS = 'Produto não encontrado.';
    const string PRODUCT_NAME_ALREADY_EXISTS = 'Já existe um produto com o nome informado.';
}
