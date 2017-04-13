import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';

import {Container} from '../../libs/blocks';
import {colors, fontSizes} from '../../libs/variables';
import {media} from '../../libs/mixins';

import Breadcrumbs from '../Breadcrumbs';
import Form from '../Form/Form';

const RegistrationStyled = styled.div`
    background-color: ${colors.white};
    padding-bottom: 30px;
`;
const RegistrationStyled__Container = styled(Container)`
`;
const Header = styled.header`
    font-weight: 500;
    text-align: center;
    font-size: ${fontSizes.m};
`;
const SubHeader = styled.div`
    text-align: center;
    font-size: ${fontSizes.xs};
    opacity: .75;
    margin: 30px 0;
    line-height: 1.5em;
`;
const SubHeader__Link = styled(Link)`
    margin-left: 5px;
    font-weight: bold;
    text-decoration: none;
`;

export default class RegistrationPage extends React.Component {

    componentWillMount() {
        this.props.setBreadcrumbs([
            {
                title: 'Личный кабинет',
                link: '/user'
            },
            {
                title: 'Регистрация',
                link: '/user/registration'
            }
        ]);
    }

    render() {
        return (
            <RegistrationStyled>
                <RegistrationStyled__Container>
                    <Breadcrumbs data={this.props.breadcrumbs}/>
                    <Header>Регистрация</Header>
                    <SubHeader>Если Вы уже зарегистрированы, перейдите на страницу
                        <SubHeader__Link to='/user'>авторизации</SubHeader__Link>.</SubHeader>
                    <Form/>
                </RegistrationStyled__Container>
            </RegistrationStyled>
        )
    }
}
