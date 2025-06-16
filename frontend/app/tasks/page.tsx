'use client'

import Card from "@/app/components/Card";
import {useEffect, useState} from "react";
import http from "@/app/http/request";
import {redirect} from "next/navigation";
import type { ColumnsType, TablePaginationConfig } from 'antd/es/table';
import {Table, Tag, Input, Select, Button} from "antd";

const { Option } = Select;

type Task = {
    id: number;
    title: string;
    description: string;
    status: string;
    due_date: string;
};

const Tasks = () => {

    const [data, setData] = useState<Task[]>([]);
    const [pagination, setPagination] = useState<TablePaginationConfig>({
        current: 1,
        pageSize: 10,
        total: 0,
    });
    const [loading, setLoading] = useState(false);
    const [sorter, setSorter] = useState<any>({});
    const [statusFilter, setStatusFilter] = useState<string | null>(null);

    const columns: ColumnsType<Task> = [
        {
            title: 'ID',
            dataIndex: 'id',
            sorter: true,
        },
        {
            title: 'Título',
            dataIndex: 'title',
            sorter: true,
        },
        {
            title: 'Descrição',
            dataIndex: 'description',
        },
        {
            title: 'Status',
            dataIndex: 'status',
            filters: [
                { text: 'Pendente', value: 'pendente' },
                { text: 'Concluída', value: 'concluida' },
            ],
            render: (status: string) => {
                let color = '';
                if (status === 'concluida') color = 'green';
                else if (status === 'pendente') color = 'orange';

                return <Tag color={color}>{status}</Tag>;
            },
            onFilter: (value, record) => record.status === value,
        },
        {
            title: 'Data de Entrega',
            dataIndex: 'due_date',
            sorter: true,
            render: (date: string) => new Date(date).toLocaleString(),
        },
    ];

    const handleTableChange = async (pagination: TablePaginationConfig, _: any, sorter: any) => {
        const userId = localStorage.getItem('userId');
        const token = localStorage.getItem('token');
        const response = await http.getAuth('/tasks/' + userId + '?page=' + pagination.current, token ?? '');
        const data = await response.json();
        setData(data.data);
        setPagination(pagination);
    };

    useEffect(() => {
        (async () => {
            const isUserLogged = await http.checkLogin(localStorage.getItem('token') || '');
            if (!isUserLogged) {
                redirect('/');
            }
            const userId = localStorage.getItem('userId');
            const token = localStorage.getItem('token');
            const response = await http.getAuth('/tasks/' + userId + '?page=1', token ?? '');
            const data = await response.json();
            setData(data.data);
            setPagination({
                ...pagination,
                total: data.total,
            });
        })()
    }, []);

    return (
        <Card title='Suas tarefas' large={true}>
            <Button title="Cadastrar" onClick={() => redirect('/tasks/create')} type="primary">Cadastrar nova tarefa</Button>
            <h1>Tarefas</h1>
            <Table
                columns={columns}
                dataSource={data}
                rowKey="id"
                loading={loading}
                pagination={pagination}
                onChange={handleTableChange}
            />
        </Card>
    );
};

export default Tasks;