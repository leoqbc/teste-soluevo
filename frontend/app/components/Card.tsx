import React from "react";
import { Card, Col, Row } from 'antd';

type Props = {
    children: React.ReactNode;
    title: string;
    large?: boolean;
};

export default ({ children, title, large = false }: Props) => (
    <Row gutter={16} style={{ marginTop: 150 }}>
        <Col span={large? 4 : 8}>
        </Col>
        <Col span={large? 16 : 8}>
            <Card title={title} variant="borderless">
                {children}
            </Card>
        </Col>
        <Col span={large? 4 : 8}>
        </Col>
    </Row>
)