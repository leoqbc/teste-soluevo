"use client";

import Card from "../components/Card";
import {Alert, Button, Form, FormProps, Input, Segmented} from "antd";
import React, {useState} from "react";
import http from "../http/request";
import {redirect} from "next/navigation";

type FieldType = {
    name?: string;
    email?: string;
    password?: string;
    password_confirmation?: string;
};

const Register = () => {
    const [form] = Form.useForm();

    const [success, setSuccess] = useState<boolean>(false);
    const [errorMessages, setErrorMessages] = useState<Array<string>>([]);
    const [loading, setLoading] = useState<boolean>(false);

    const onFinish: FormProps<FieldType>['onFinish'] = (values) => {
        setLoading(true);
        setErrorMessages([]);
        (async () => {
            const response = await http.post('/register', values);
            const data = await response.json();

            if (response.status === 201) {
                setSuccess(true);
                form.resetFields();
                localStorage.setItem('token', data.access_token);
                redirect('/tasks');
            } else {
                const { errors } = data;
                let errorsBack: string[] = [];
                for (const field in errors) {
                    errorsBack.push(errors[field]);
                }
                setErrorMessages(errorsBack);
            }
            setLoading(false);
        })();
    };

    return (
        <Card title={"Faça seu cadastro"}>
            <Form
                form={form}
                style={{ maxWidth: 600 }}
                layout="vertical"
                onFinish={onFinish}
            >
                <Form.Item label="Nome" name="name" rules={[{ required: true, message: 'Digite o seu nome' }]}>
                    <Input />
                </Form.Item>
                <Form.Item label="Email" name="email" rules={[{ required: true, message: 'Digite o seu email' }]}>
                    <Input />
                </Form.Item>
                <Form.Item label="Senha" name="password" rules={[
                    { required: true, message: 'Digite a sua senha' },
                    { min: 8, message: 'Escolha pelo menos 8 caracteres' }
                ]}>
                    <Input.Password />
                </Form.Item>
                <Form.Item label="Confirme sua senha" name="password_confirmation" rules={[
                    { required: true, message: 'Confirme sua senha' },
                    { min: 8, message: 'Escolha pelo menos 8 caracteres' }
                ]}>
                    <Input.Password />
                </Form.Item>
                {success &&
                    <Form.Item>
                        <Alert message="Cadastro feito com sucesso" type="success" showIcon />
                    </Form.Item>
                }
                {errorMessages.map((value, key) => (
                            <Form.Item>
                                <Alert key={key} message={value} type="error" showIcon />
                            </Form.Item>
                        )
                    )
                }
                <Button type="primary" htmlType="submit" loading={loading} block>
                    {loading ? 'Cadastrando...' : 'Cadastrar'}
                </Button>
            </Form>
        </Card>
    );
}

export default Register;