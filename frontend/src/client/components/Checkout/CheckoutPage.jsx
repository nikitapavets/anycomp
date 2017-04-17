import React from 'react';
import {browserHistory} from 'react-router';
import styled from 'styled-components';

import {Container} from '../../libs/blocks';
import {colors, fontSizes} from '../../libs/variables';
import Form from '../Form/Form';
import FormBlock from '../Form/FormBlock';
import FormInput from '../Form/FormInput';
import FormRadio from '../Form/FormRadio';
import Accordion from '../Accordion/Accordion';
import Panel from '../Accordion/Panel';

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
    .rc-collapse-item {
        border: 1px solid ${colors.minor};
        margin: 5px 0;
    }
    .rc-collapse-item {
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
const Accordion__Title = styled.header`
    font-size: ${fontSizes.xl};
    font-weight: 500;
    margin-bottom: 30px;
`;
const Accordion__Description = styled.div`
    font-size: ${fontSizes.xs};
    line-height: 1.5em;
`;
const FormRadioWrap = styled.div`
    margin: 10px 0;
`;


export default class CheckoutPage extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            activateNextPanel: null
        }
    }

    componentWillMount() {
        this.props.setBreadcrumbs([
            {
                title: 'Оформление заказа',
                link: '/checkout'
            }
        ]);
    }

    handleFirstStep = (params) => {
        params = JSON.parse(params);
        if (params.auth_type == 'reg' && !this.props.users.auth) {
            browserHistory.push('/user');
        } else {
            this.state.activateNextPanel();
        }
    };

    handleSecondStep = (params) => {
        this.props.handleRegistrationUser(params);
    };

    initAccordion = (activateNextPanelFunc) => {
        this.setState({
            activateNextPanel: activateNextPanelFunc
        });
    };

    render() {
        const error = this.props.users.error;
        const stepOneRadio = [
            {
                name: 'auth_type',
                value: 'reg',
                title: 'Регистрация/Авторизация',
            },
            {
                name: 'auth_type',
                value: 'no_reg',
                title: 'Оформить заказ без регистрации',
            }
        ];
        const FIRST_STEP_FORM = 'firstStep';
        const SECOND_STEP_FORM = 'secondStep';
        const ACTIVE_PANEL = this.props.users.auth ? 1 : 0;

        return (
            <LoginStyled>
                <LoginStyled__Container>
                    <Breadcrumbs data={this.props.breadcrumbs}/>
                    <Header>Оформление заказа</Header>
                    <AccordionStyled>
                        <Accordion initAccordion={this.initAccordion} activePanel={ACTIVE_PANEL}>
                            <Panel header='Шаг 1: Оформление заказа'>
                                <Form id={FIRST_STEP_FORM} handle={this.handleFirstStep} button='Продолжить'>
                                    <Accordion__Description>Варианты Оформления заказа</Accordion__Description>
                                    <FormRadioWrap>
                                        <FormRadio items={stepOneRadio}/>
                                    </FormRadioWrap>
                                    <Accordion__Description>Создание учётной записи поможет делать покупки
                                        быстрее и удобнее, а так же получать скидки как постоянный
                                        покупатель.</Accordion__Description>
                                </Form>
                            </Panel>

                            <Panel header='Шаг 2: Платежная информация'>
                                <Form id={SECOND_STEP_FORM} handle={this.handleSecondStep} button='Продолжить'>
                                    <FormBlock title='Основная информация'>
                                        <FormInput name='client_id'
                                                   type="hidden"
                                                   value={this.props.users.current.id}/>
                                        <FormInput title='Фамилия' name='client_second_name'
                                                   value={this.props.users.current.second_name}
                                                   error={error.client_second_name}
                                                   required/>
                                        <FormInput title='Имя' name='client_first_name' error={error.client_first_name}
                                                   value={this.props.users.current.first_name}
                                                   required/>
                                        <FormInput title='Отчество' name='client_father_name'
                                                   value={this.props.users.current.father_name}
                                                   error={error.client_father_name}
                                                   required/>
                                        <FormInput title='E-mail' name='client_email' type='email'
                                                   value={this.props.users.current.email}
                                                   error={error.client_email}
                                                   required/>
                                        <FormInput title='Телефон' name='client_mobile_phone' type='phone'
                                                   value={this.props.users.current.mobile_phone}
                                                   error={error.client_mobile_phone}
                                                   required/>
                                    </FormBlock>
                                    <FormBlock title='Ваш адрес'>
                                        <FormInput title='Компания' name='client_organization_new'
                                                   value={this.props.users.current.organization}
                                                   error={error.client_organization_new}/>
                                        <FormInput title='Город' name='client_city_new'
                                                   value={this.props.users.current.address_city}
                                                   error={error.client_city_new}/>
                                        <FormInput title='Улица' name='client_street'
                                                   value={this.props.users.current.address_street}
                                                   error={error.client_street}/>
                                        <FormInput title='Дом' name='client_house'
                                                   value={this.props.users.current.address_house}
                                                   error={error.client_house}/>
                                        <FormInput title='Квартира' name='client_flat'
                                                   value={this.props.users.current.address_flat}
                                                   error={error.client_flat}/>
                                    </FormBlock>
                                </Form>
                            </Panel>

                            <Panel header='Шаг 3: Способ оплаты'>
                                <p>And this Accordion component is also completely repsonsive. Hurrah for mobile
                                    users!</p>
                            </Panel>
                        </Accordion>
                    </AccordionStyled>
                </LoginStyled__Container>
            </LoginStyled>
        )
    }
}