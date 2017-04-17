import React from 'react';
import Accordion from 'react-responsive-accordion';
import styled from 'styled-components';

import {Container} from '../../libs/blocks';
import {colors, fontSizes} from '../../libs/variables';
import Form from '../Form/Form';
import FormBlock from '../Form/FormBlock';
import FormInput from '../Form/FormInput';
import FormRadio from '../Form/FormRadio';

import Breadcrumbs from '../Breadcrumbs';

const LoginStyled = styled.div`
    background-color: ${colors.white};
    padding-bottom: 30px;
`;
const LoginStyled__Container = styled(Container)`
    background-color: ${colors.white};
`;
const Header = styled.header`
    font-weight: 500;
    text-align: center;
    font-size: ${fontSizes.xxl};
    padding-bottom: 15px;
    margin-bottom: 30px;
    border-bottom: 1px solid ${colors.minor};
`;
const AccordionStyled = styled.div`
    .Collapsible {
        border: 1px solid ${colors.minor};
        margin: 5px 0;
    }
    .Collapsible__trigger {
        display: block;
        padding: 15px;
        background: ${colors.minor};
        font-weight: 500;
        cursor: pointer;
        border-bottom: 1px solid ${colors.minor};
    }
    .Collapsible__contentInner {
        padding: 15px;
    }
`;
const Accordion__Item = styled.div`
`;


export default class CheckoutPage extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            stepOneRadio: [
                {
                    name: 'auth_type',
                    value: 'authorization',
                    title: 'Авторизация',
                },
                {
                    name: 'auth_type',
                    value: 'registration',
                    title: 'Регистрация',
                }
            ]
        };
    }


    componentWillMount() {
        this.props.setBreadcrumbs([
            {
                title: 'Оформление заказа',
                link: '/checkout'
            }
        ]);
    }

    handleAuth = (e) => {
        e.preventDefault();

    };

    render() {
        const error = this.props.users.error;

        return (
            <LoginStyled>
                <LoginStyled__Container>
                    <Breadcrumbs data={this.props.breadcrumbs}/>
                    <Header>Оформление заказа</Header>
                    <AccordionStyled>
                        <Accordion>
                            <Accordion__Item data-trigger='Шаг 1: Оформление заказа'>
                                <Form handle={this.props.handleRegistrationUser} button='Продолжить'>
                                    <FormRadio items={this.state.stepOneRadio}/>
                                </Form>
                            </Accordion__Item>

                            <Accordion__Item data-trigger='Шаг 2: Платежная информация'>
                                <Form handle={this.props.handleRegistrationUser} button='Продолжить'>
                                    <FormBlock title='Основная информация'>
                                        <FormInput title='Фамилия' name='client_second_name'
                                                   error={error.client_second_name} required/>
                                        <FormInput title='Имя' name='client_first_name' error={error.client_first_name}
                                                   required/>
                                        <FormInput title='Отчество' name='client_father_name'
                                                   error={error.client_father_name}/>
                                        <FormInput title='E-mail' name='client_email' type='email'
                                                   error={error.client_email} required/>
                                        <FormInput title='Телефон' name='client_mobile_phone' type='phone'
                                                   error={error.client_mobile_phone} required/>
                                    </FormBlock>
                                    <FormBlock title='Ваш адрес'>
                                        <FormInput title='Компания' name='client_organization_new'
                                                   error={error.client_organization_new}/>
                                        <FormInput title='Город' name='client_city_new' error={error.client_city_new}/>
                                        <FormInput title='Улица' name='client_street' error={error.client_street}/>
                                        <FormInput title='Дом' name='client_house' error={error.client_house}/>
                                        <FormInput title='Квартира' name='client_flat' error={error.client_flat}/>
                                    </FormBlock>
                                    <FormBlock title='Ваш пароль'>
                                        <FormInput title='Пароль' type='password' name='client_password'
                                                   error={error.client_password} required/>
                                        <FormInput title='Повторите пароль' type='password'
                                                   name='client_password_confirmation'
                                                   error={error.client_password_confirmed} required/>
                                    </FormBlock>
                                </Form>
                            </Accordion__Item>

                            <Accordion__Item data-trigger='Шаг 3: Способ оплаты'>
                                <p>And this Accordion component is also completely repsonsive. Hurrah for mobile
                                    users!</p>
                            </Accordion__Item>
                        </Accordion>
                    </AccordionStyled>
                </LoginStyled__Container>
            </LoginStyled>
        )
    }
}
