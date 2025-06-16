import React from "react";
import { Card, Col, Row } from 'antd';

type Props = {
    children: React.ReactNode;
    title: string;
};

export default ({ children, title }: Props) => (
    <Row gutter={16} style={{ marginTop: 150 }}>
        <Col span={8}>
        </Col>
        <Col span={8}>
            <Card title={title} variant="borderless">
                {children}
            </Card>
        </Col>
        <Col span={8}>
        </Col>
    </Row>
)