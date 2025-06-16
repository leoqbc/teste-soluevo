'use client'

import {Alert, Button, DatePicker, Form, FormProps, Input, Select} from "antd";
import {useEffect, useState} from "react";
import Card from "@/app/components/Card";
import http from "@/app/http/request";
import {redirect} from "next/navigation";
import dayjs from "dayjs";

type FieldType = {
    title?: string;
    description?: string;
    status?: number;
    due_date?: string;
    user_id?: string;
};

export default () => {
    useEffect(() => {
        (async () => {
            const isUserLogged = await http.checkLogin(localStorage.getItem('token') || '');
            if (!isUserLogged) {
                redirect('/');
            }
        })()
    }, []);

    const [form] = Form.useForm();

    const [success, setSuccess] = useState<boolean>(false);
    const [errorMessages, setErrorMessages] = useState<Array<string>>([]);
    const [loading, setLoading] = useState<boolean>(false);

    const onFinish: FormProps<FieldType>['onFinish'] = async (values) => {
        values.due_date = dayjs(values.due_date).format('YYYY-MM-DD 00:00:00');
        values.user_id = localStorage.getItem('userId') ?? '0';
        const response = await http.postAuth('/tasks', values, localStorage.getItem('token') || '');
        setLoading(true);
        setErrorMessages([]);
        if (response.ok) {
            setLoading(false);
            redirect('/tasks');
        }
    }

    return (
        <Card title={"Cadastrar Tarefa"}>
            <Form
                form={form}
                style={{ maxWidth: 600 }}
                layout="vertical"
                onFinish={onFinish}
            >
                <Form.Item
                    label="Título"
                    name="title"
                    rules={[{ required: true, message: 'Digite o título da tarefa' }]}
                >
                    <Input />
                </Form.Item>

                <Form.Item
                    label="Descrição"
                    name="description"
                    rules={[{ required: true, message: 'Digite a descrição da tarefa' }]}
                >
                    <Input.TextArea rows={4} />
                </Form.Item>

                <Form.Item
                    label="Status"
                    name="status"
                    rules={[{ required: true, message: 'Selecione o status da tarefa' }]}
                >
                    <Select placeholder="Selecione o status">
                        <Select.Option value="pendente">Pendente</Select.Option>
                        <Select.Option value="concluida">Concluída</Select.Option>
                    </Select>
                </Form.Item>

                <Form.Item
                    label="Data de Prazo"
                    name="due_date"
                    rules={[{ required: true, message: 'Selecione a data de prazo' }]}
                >
                    <DatePicker format="DD/MM/YYYY 00:00:00" defaultValue={dayjs()} style={{ width: '100%' }} />
                </Form.Item>

                {success &&
                    <Form.Item>
                        <Alert message="Tarefa cadastrada com sucesso" type="success" showIcon />
                    </Form.Item>
                }

                {errorMessages.map((value, key) => (
                    <Form.Item key={key}>
                        <Alert message={value} type="error" showIcon />
                    </Form.Item>
                ))}

                <Button type="primary" htmlType="submit" loading={loading} block>
                    {loading ? 'Salvando...' : 'Cadastrar Tarefa'}
                </Button>
            </Form>
        </Card>
    );
}