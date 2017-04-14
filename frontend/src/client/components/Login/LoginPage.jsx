import React from 'react';
import styled from 'styled-components';
import {Link} from 'react-router';

import {Container} from '../../libs/blocks';
import {colors, fontSizes} from '../../libs/variables';
import {media} from '../../libs/mixins';
import Dom from '../../../core/scripts/dom';

import Breadcrumbs from '../Breadcrumbs';

const LoginStyled = styled.div`
    background-color: ${colors.white};
    padding-bottom: 30px;
`;
const LoginStyled__Container = styled(Container)`
    background-color: ${colors.white};
`;
const Enter = styled.div`
    ${media.tablet`
        display: flex;
    `}
`;
const Enter__Block = styled.div`
    border: 2px solid ${colors.minor};
    padding: 30px;
    margin-bottom: 30px;
    &:last-child {
        margin: 0;
    }
    ${media.tablet`
        margin: 0;
        flex: 1 1;
        margin-right: 30px;
        &:last-child {
            margin: 0;
        }
    `}
`;
const Enter__Header = styled.header`
    font-size: ${fontSizes.xl};
    font-weight: 500;
    margin-bottom: 30px;
`;
const Enter__SubHeader = styled.header`
    font-size: ${fontSizes.s};
    font-weight: 500;
`;
const Enter__Description = styled.header`
    font-size: ${fontSizes.s};
    margin: 30px 0;
    padding: 15px 0;
    line-height: 1.5em;
    opacity: .75;
    border-top: 1px solid ${colors.minor};
    border-bottom: 1px solid ${colors.minor};
`;
const Enter__Button = styled(Link)`
    display: inline-block;
    font-size: ${fontSizes.s};
    background-color: ${colors.main};
    border: none;
    padding: 5px 10px;
    color: ${colors.white};
    text-decoration: none;
    font-weight: 500;
`;
const Enter__Input = styled.input`
    display: block;
    width: 100%;
    padding: 10px 15px;
    background: ${colors.minor};
    border: none;
    margin: 10px 0;
    outline: none;
    border: 2px solid ${colors.minor};
    &:focus {
        border: 2px solid ${colors.main};
    }
`;
const Error = styled.div`
    font-size: ${fontSizes.xs};
    color: ${colors.red};
    margin-top: 5px;
`;
const Info = styled(Error)`
    color: ${colors.main};
`;

const FORM_ID = 'sendForm';

export default class LoginPage extends React.Component {

    componentWillMount() {
        this.props.setBreadcrumbs([
            {
                title: 'Личный кабинет',
                link: '/user'
            }
        ]);
    }

    handleAuth = (e) => {
        e.preventDefault();

        const params = Dom.formItems(FORM_ID);
        this.props.handleLogin(params);
    };

    render() {
        return (
            <LoginStyled>
                <LoginStyled__Container>
                    <Breadcrumbs data={this.props.breadcrumbs}/>
                    <Enter>
                        <Enter__Block>
                            <Enter__Header>Новый клиент</Enter__Header>
                            <Enter__SubHeader>Регистрация</Enter__SubHeader>
                            <Enter__Description>Создание учетной записи поможет покупать быстрее. Вы сможете
                                контролировать состояние заказа, а также просматривать заказы сделанные ранее. Вы
                                сможете накапливать призовые баллы и получать скидочные купоны.А постоянным покупателям
                                мы предлагаем гибкую систему скидок и персональное обслуживание.</Enter__Description>
                            <Enter__Button to='/user/registration'>Регистрация</Enter__Button>
                        </Enter__Block>
                        <Enter__Block>
                            <Enter__Header>Зарегистрированный клиент</Enter__Header>
                            <Enter__SubHeader>Войти в Личный Кабинет</Enter__SubHeader>
                            <form id={FORM_ID} onSubmit={this.handleAuth}>
                                <Enter__Description>
                                    <Enter__Input name='client_email' type='text' placeholder='E-mail'/>
                                    <Enter__Input name='client_password' type='password' placeholder='Пароль'/>
                                    {this.props.users.error
                                        ? <Error>{this.props.users.error }</Error>
                                        : <Info>Используйте Ваш email и пароль для входа.</Info>
                                    }
                                </Enter__Description>
                                <Enter__Button type='submit' >Войти</Enter__Button>
                            </form>
                        </Enter__Block>
                    </Enter>
                </LoginStyled__Container>
            </LoginStyled>
        )
    }
}
