'use client'

import React, {useState} from 'react';
import {Alert, Flex, FormProps} from 'antd';
import { Button, Checkbox, Form, Input } from 'antd';
import Card from './components/Card';
import { UserOutlined, LockOutlined } from "@ant-design/icons";

type FieldType = {
    email?: string;
    password?: string;
    remember?: string;
};

const Home = () => {
    const [errorMessage, setErrorMessage] = useState('');

    const onFinish: FormProps<FieldType>['onFinish'] = (values) => {
        setErrorMessage('Erro ao fazer login.');
    };

    return (
        <div className="App">
            <Card title="Faça seu login">
                <Form
                    name="login"
                    initialValues={{ remember: true }}
                    onFinish={onFinish}
                >
                    <Form.Item
                        name="email"
                        rules={[
                            {
                                required: true, message: 'Por favor insira seu email!'
                            },
                            {
                                type: 'email',
                                message: 'Insira um e-mail válido!',
                            }
                        ]}
                    >
                        <Input prefix={<UserOutlined />} placeholder="Email" />
                    </Form.Item>
                    <Form.Item
                        name="password"
                        rules={[{ required: true, message: 'Por favor insira sua senha!' }]}
                    >
                        <Input.Password prefix={<LockOutlined />} placeholder="Senha" />
                    </Form.Item>
                    <Form.Item>
                        <Flex justify="space-between" align="center">
                            <Form.Item name="remember" valuePropName="checked" noStyle>
                                <Checkbox>Lembre-me</Checkbox>
                            </Form.Item>
                            {/*<a href="">Forgot password</a>*/}
                        </Flex>
                    </Form.Item>
                    {errorMessage &&
                        <Form.Item>
                            <Alert message={errorMessage} type="error" showIcon />
                        </Form.Item>
                    }
                    <Form.Item>
                        <Button block type="primary" htmlType="submit">
                            Logar
                        </Button>
                        ou <a href="/register">Cadastre-se!</a>
                    </Form.Item>
                </Form>
            </Card>
        </div>
    );
};

export default Home;